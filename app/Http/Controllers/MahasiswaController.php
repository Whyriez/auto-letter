<?php

namespace App\Http\Controllers;

use App\Models\LetterRequests;
use App\Models\LetterTemplate;
use App\Models\LetterTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MahasiswaController extends Controller
{
    public function index()
    {
        $letterTypes = LetterTemplate::all();
        $letterHistory = LetterRequests::where('user_id', 5)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('mahasiswa.index', compact('letterTypes', 'letterHistory'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'letter-type' => ['required', 'exists:letter_types,id'],
            'purpose' => ['required', 'string', 'max:255'],
            'deadline' => ['required', 'date', 'after_or_equal:today'],
            'additional_names.*' => ['nullable', 'string', 'max:255'],
            'additional_nims.*' => ['nullable', 'string', 'max:255'],
            'research_lecturer' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'waktu' => ['nullable', 'string', 'max:255'],
            'course' => ['nullable', 'string', 'max:255'],
        ]);

        // Kumpulkan data mahasiswa tambahan ke dalam array
        $additionalStudents = [];
        $additionalNames = $validatedData['additional_names'] ?? [];
        $additionalNims = $validatedData['additional_nims'] ?? [];
        foreach ($additionalNames as $key => $name) {
            $additionalStudents[] = [
                'name' => $name,
                'nim' => $additionalNims[$key] ?? null,
            ];
        }

        // Kumpulkan semua detail tambahan ke dalam satu array
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

        $letterTemplate = LetterTemplate::where('letter_type_id', $validatedData['letter-type'])->first();
        if (!$letterTemplate) {
            return redirect()->back()->with('error', 'Jenis surat tidak valid.');
        }
        $userId = $letterTemplate->forward_to;
        
        // Menyimpan Data ke Database
        $letterRequest = new LetterRequests();
        $letterRequest->user_id = $userId;
        $letterRequest->letter_template_id = $validatedData['letter-type'];
        $letterRequest->status = 'pending';
        $letterRequest->unique_code = Str::uuid();
        $letterRequest->request_details = $requestDetails;
        $letterRequest->notes = $validatedData['purpose'];
        $letterRequest->needed_at = $validatedData['deadline'];
        $letterRequest->save();

        return redirect()->route('mahasiswa.index')->with('success', 'Permintaan surat berhasil diajukan!');
    }
}
