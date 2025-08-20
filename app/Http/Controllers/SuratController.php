<?php

namespace App\Http\Controllers;

use App\Models\LetterTemplate;
use App\Models\LetterTypes;
use App\Models\User;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $query = LetterTemplate::withCount('letterRequests')
            ->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $query->where('nama_surat', 'like', '%' . $request->search . '%')
                ->orWhere('konten', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('letter_type_id', $request->kategori);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $templates = $query->paginate(10)->withQueryString();

        $users = User::whereIn('role', ['kaprodi', 'kajur'])->get();

        $letterTypes = LetterTypes::all();

        return view('admin.jurusan.surat', compact('templates', 'users', 'letterTypes'));
    }


    public function duplicate(LetterTemplate $template)
    {
        $newTemplate = $template->replicate();

        $newTemplate->nama_surat = $template->nama_surat . ' (Copy)';
        $newTemplate->status = 'draft';

        $newTemplate->save();

        $notification = [
            'message' => 'Template berhasil diduplikasi!',
            'type' => 'success',
        ];
        return redirect()->back()->with('notification', $notification);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'template_category' => 'required|string',
            'template_name'     => 'required|string',
            'kode_seri'         => 'required|string',
            'kode_unit'         => 'required|string',
            'kode_arsip'        => 'required|string',
            'perihal'       => 'required|string',
            'tujuan_nama'       => 'required|string',
            'tujuan_tempat'     => 'required|string',
            'konten'            => 'required|string',
            'forward_to'        => 'required|exists:users,id',
            'status'            => 'required|string|in:draft,active,archived',
        ], [
            'template_category.required' => 'Kategori template wajib diisi.',
            'template_name.required'     => 'Nama template wajib diisi.',
            'kode_seri.required'         => 'Kode seri wajib diisi.',
            'kode_unit.required'         => 'Kode unit wajib diisi.',
            'kode_arsip.required'        => 'Kode arsip wajib diisi.',
            'perihal.required'       => 'Perihal wajib diisi.',
            'tujuan_nama.required'       => 'Nama tujuan wajib diisi.',
            'tujuan_tempat.required'     => 'Tempat tujuan wajib diisi.',
            'konten.required'            => 'Konten surat wajib diisi bwang.',
            'status.required'            => 'Status wajib dipilih.',
            'status.in'                  => 'Status hanya boleh draft, active, atau archived.',
            'forward_to.required'        => 'Pengirim surat wajib dipilih.',
            'forward_to.exists'          => 'Pengirim surat tidak ditemukan.',
        ]);

        LetterTemplate::create([
            'letter_type_id'               => $validated['template_category'],
            'nama_surat'             => $validated['template_name'],
            'kode_seri'              => $validated['kode_seri'],
            'kode_unit'              => $validated['kode_unit'],
            'kode_arsip'             => $validated['kode_arsip'],
            'perihal'            => $validated['perihal'],
            'tujuan_nama'            => $validated['tujuan_nama'],
            'tujuan_lokasi'          => $validated['tujuan_tempat'],
            'konten'                 => $validated['konten'],
            'forward_to'             => $validated['forward_to'],
            'status'                 => $validated['status'],
        ]);

        $notification = [
            'message' => 'Template surat berhasil ditambahkan!',
            'type' => 'success',
        ];
        return redirect()->back()->with('notification', $notification);
    }

    public function update(Request $request, $id)
    {
        $template = LetterTemplate::findOrFail($id);

        $template->update([
            'nama_surat'   => $request->template_name,
            'letter_type_id'     => $request->template_category,
            'kode_seri'    => $request->kode_seri,
            'kode_unit'    => $request->kode_unit,
            'kode_arsip'   => $request->kode_arsip,
            'perihal'  => $request->perihal,
            'tujuan_nama'  => $request->tujuan_nama,
            'tujuan_tempat' => $request->tujuan_tempat,
            'konten'       => $request->konten,
            'status'       => $request->status,
            'forward_to'    => $request->forward_to,
        ]);

        $notification = [
            'message' => 'Template berhasil diupdate!',
            'type' => 'success',
        ];
        return redirect()->route('template-surat.index')->with('notification', $notification);
    }
}
