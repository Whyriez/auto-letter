<?php

namespace App\Http\Controllers;

use App\Models\LetterTypes;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
     public function index(Request $request)
    {
        $query = LetterTypes::query();

        // Filter search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $letterTypes = $query->paginate(10)->withQueryString();

        return view('admin.jurusan.jsurat', compact('letterTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:letter_types,name',
        ]);

        LetterTypes::create([
            'name' => $validated['name']
        ]);

        return redirect()->route('letter-types.index')->with('success', 'Jenis surat berhasil ditambahkan!');
    }

     public function update(Request $request, LetterTypes $letterType)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:letter_types,name,' . $letterType->id,
        ]);

        $letterType->update([
            'name' => $validated['name']
        ]);

        return redirect()->route('letter-types.index')->with('success', 'Jenis surat berhasil diperbarui!');
    }

     public function destroy(LetterTypes $letterType)
    {
        $letterType->delete();

        return redirect()->route('letter-types.index')->with('success', 'Jenis surat berhasil dihapus!');
    }
}
