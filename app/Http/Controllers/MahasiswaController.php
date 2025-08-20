<?php

namespace App\Http\Controllers;

use App\Models\LetterRequests;
use App\Models\LetterTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MahasiswaController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $totalLetters = LetterRequests::where('user_id', $userId)->count();
        $pendingLetters = LetterRequests::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();

        $approvedLetters = LetterRequests::where('user_id', $userId)
            ->where('status', 'completed')
            ->count();

        $letterTypes = LetterTemplate::all();
        $letterHistory = LetterRequests::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('mahasiswa.index', compact('letterTypes', 'letterHistory', 'totalLetters', 'pendingLetters', 'approvedLetters'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'letter-type' => ['required', 'exists:letter_templates,id'],
            'purpose' => ['required', 'string', 'max:255'],
            'deadline' => ['required', 'date', 'after_or_equal:today'],
            'additional_names.*' => ['nullable', 'string', 'max:255'],
            'additional_nims.*' => ['nullable', 'string', 'max:255'],
            'research_lecturer' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'waktu' => ['nullable', 'string', 'max:255'],
            'course' => ['nullable', 'string', 'max:255'],
        ]);

        try {
            $additionalStudents = [];
            $additionalNames = $validatedData['additional_names'] ?? [];
            $additionalNims = $validatedData['additional_nims'] ?? [];
            foreach ($additionalNames as $key => $name) {
                $additionalStudents[] = [
                    'name' => $name,
                    'nim' => $additionalNims[$key] ?? null,
                ];
            }

            $requestDetails = [];
            if (!empty($additionalStudents)) {
                $requestDetails['additional_students'] = $additionalStudents;
            }
            if ($request->filled('location')) {
                $requestDetails['location'] = $validatedData['location'];
            }
            if ($request->filled('waktu')) {
                $requestDetails['waktu'] = $validatedData['waktu'];
            }
            if ($request->filled('course')) {
                $requestDetails['course'] = $validatedData['course'];
            }

            $letterTemplate = LetterTemplate::where('id', $validatedData['letter-type'])->first();
            if (!$letterTemplate) {
                $notification = [
                    'message' => 'Jenis surat tidak valid.',
                    'type' => 'error'
                ];
                return redirect()->back()->with('notification', $notification);
            }

            $userId = Auth::user()->id;

            $letterRequest = new LetterRequests();
            $letterRequest->user_id = $userId;
            $letterRequest->letter_template_id = $validatedData['letter-type'];
            $letterRequest->status = 'pending';
            $letterRequest->unique_code = Str::uuid();
            $letterRequest->request_details = $requestDetails;
            $letterRequest->notes = $validatedData['purpose'];
            $letterRequest->needed_at = $validatedData['deadline'];
            $letterRequest->save();

            $notification = [
                'message' => 'Permintaan surat berhasil diajukan!',
                'type' => 'success'
            ];
            return redirect()->route('mahasiswa.index')->with('notification', $notification);
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Terjadi kesalahan saat mengajukan permintaan surat.',
                'type' => 'error'
            ];
            return redirect()->back()->with('notification', $notification);
        }
    }
}
