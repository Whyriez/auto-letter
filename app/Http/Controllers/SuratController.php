<?php

namespace App\Http\Controllers;

use App\Models\LetterTemplate;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $query = LetterTemplate::withCount('letterRequests')
            ->orderBy('created_at', 'desc');

        // filter search
        if ($request->filled('search')) {
            $query->where('nama_surat', 'like', '%' . $request->search . '%')
                ->orWhere('konten', 'like', '%' . $request->search . '%');
        }

        // filter kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $templates = $query->paginate(10)->withQueryString();

        return view('admin.jurusan.index', compact('templates'));
    }



    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'template_category' => 'required|string',
            'template_name'     => 'required|string',
            'kode_seri'         => 'required|string',
            'kode_unit'         => 'required|string',
            'kode_arsip'        => 'required|string',
            'tujuan_nama'       => 'required|string',
            'tujuan_tempat'     => 'required|string',
            'konten'            => 'required|string',
            'status'            => 'required|string|in:draft,active,archived',
        ], [
            'template_category.required' => 'Kategori template wajib diisi.',
            'template_name.required'     => 'Nama template wajib diisi.',
            'kode_seri.required'         => 'Kode seri wajib diisi.',
            'kode_unit.required'         => 'Kode unit wajib diisi.',
            'kode_arsip.required'        => 'Kode arsip wajib diisi.',
            'tujuan_nama.required'       => 'Nama tujuan wajib diisi.',
            'tujuan_tempat.required'     => 'Tempat tujuan wajib diisi.',
            'konten.required'            => 'Konten surat wajib diisi.',
            'status.required'            => 'Status wajib dipilih.',
            'status.in'                  => 'Status hanya boleh draft, active, atau archived.',
        ]);


        // dd($validated);

        $value = LetterTemplate::create([
            'kategori'               => $validated['template_category'],
            'nama_surat'             => $validated['template_name'],
            'kode_seri'              => $validated['kode_seri'],
            'kode_unit'              => $validated['kode_unit'],
            'kode_arsip'             => $validated['kode_arsip'],
            'tujuan_nama'            => $validated['tujuan_nama'],
            'tujuan_lokasi'          => $validated['tujuan_tempat'],
            'konten'                 => $validated['konten'],
            'requires_kaprodi'       => $request->has('requires_kaprodi') ? 1 : 0,
            'requires_ketua_jurusan' => $request->has('requires_ketua_jurusan') ? 1 : 0,
            'status'                 => $validated['status'],
        ]);



        return redirect()->back()->with('success', 'Template surat berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $template = LetterTemplate::findOrFail($id);

        $template->update([
            'nama_surat'   => $request->template_name,
            'kategori'     => $request->template_category,
            'kode_seri'    => $request->kode_seri,
            'kode_unit'    => $request->kode_unit,
            'kode_arsip'   => $request->kode_arsip,
            'tujuan_nama'  => $request->tujuan_nama,
            'tujuan_tempat' => $request->tujuan_tempat,
            'konten'       => $request->konten,
            'status'       => $request->status,
            'requires_kaprodi'    => $request->has('requires_kaprodi') ? 1 : 0,
            'requires_ketua_jurusan' => $request->has('requires_ketua_jurusan') ? 1 : 0,
        ]);

        return redirect()->route('letter-templates.index')->with('success', 'Template berhasil diupdate');
    }
}
