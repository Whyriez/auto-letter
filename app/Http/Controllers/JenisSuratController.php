<?php

namespace App\Http\Controllers;

use App\Models\LetterTypes;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    public function index(Request $request)
    {
        $query = LetterTypes::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $letterTypes = $query->paginate(10)->withQueryString();

        return view('admin.jurusan.jenis_surat', compact('letterTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:letter_types,name',
        ]);

        LetterTypes::create([
            'name' => $validated['name']
        ]);

        $notification = [
            'message' => 'Jenis surat berhasil ditambahkan!',
            'type' => 'success',
        ];
        return redirect()->route('jenis-surat.index')->with('notification', $notification);
    }

    public function update(Request $request, LetterTypes $jenisSurat)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:letter_types,name,' . $jenisSurat->id,
        ]);

        $jenisSurat->update([
            'name' => $validated['name']
        ]);

        $notification = [
            'message' => 'Jenis surat berhasil diperbarui!',
            'type' => 'success',
        ];
        return redirect()->route('jenis-surat.index')->with('notification', $notification);
    }

    public function destroy(LetterTypes $jenisSurat)
    {
        $jenisSurat->delete();

        $notification = [
            'message' => 'Jenis surat berhasil dihapus!',
            'type' => 'success',
        ];
        return redirect()->route('jenis-surat.index')->with('notification', $notification);
    }
}
