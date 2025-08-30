<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function edit_profile()
    {
        return view('settings.profile');
    }

    public function update_profile(Request $request)
    {
        $user = $request->user();
        $role = $user->role ?? 'mahasiswa';

        $needsQRCode = in_array($role, ['kajur', 'kaprodi']);

        $rules = [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];

        if ($needsQRCode) {
            $rules['ttd_qr'] = [
                'nullable',
                'file',
                'max:2048',
                'mimetypes:image/*',
                'mimes:jpg,jpeg,png,webp,svg,',
            ];
        }

        $messages = [
            'name.required'       => 'Nama wajib diisi.',
            'email.required'      => 'Email wajib diisi.',
            'email.email'         => 'Format email tidak valid.',
            'email.unique'        => 'Email ini sudah digunakan.',
            'password.min'        => 'Kata sandi minimal :min karakter.',
            'password.confirmed'  => 'Konfirmasi kata sandi tidak cocok.',
            'ttd_qr.file'         => 'Berkas QR tidak valid.',
            'ttd_qr.max'          => 'Ukuran QR maksimal 2MB.',
            'ttd_qr.mimes'     => 'Format TTD harus berupa gambar (jpg, jpeg, png, webp, svg).',
            'ttd_qr.mimetypes' => 'Format TTD harus berupa gambar.',
        ];

        $validated = $request->validate($rules, $messages);

        if ($needsQRCode && empty($user->signature_image_path) && !$request->hasFile('ttd_qr')) {
            return back()
                ->withErrors(['ttd_qr' => 'QR Code TTD wajib diunggah untuk peran ' . strtoupper($role) . '.'])
                ->withInput();
        }

        if (!$needsQRCode && $request->hasFile('ttd_qr')) {
            return back()
                ->withErrors(['ttd_qr' => 'Pengunggahan QR Code TTD hanya untuk Kajur/Kaprodi.'])
                ->withInput();
        }

        $updateData = [
            'name'  => $validated['name'],
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        if ($needsQRCode && $request->hasFile('ttd_qr')) {
            if (!empty($user->signature_image_path)) {
                $this->deleteExistingSignature($user->signature_image_path);
            }
            $path = $request->file('ttd_qr')->store('ttd_qr', 'public');    
            $updateData['signature_image_path'] = Storage::url($path);  
        }

        $user->update($updateData);

        return back()->with('notification', [
            'message' => 'Profil berhasil diperbarui.',
            'type'    => 'success',
        ]);
    }

    public function destroyQr(Request $request)
    {
        $user = $request->user();
        $role = $user->role ?? 'mahasiswa';

        if (!in_array($role, ['kajur', 'kaprodi'])) {
            return response()->json(['message' => 'Tidak diizinkan.'], 403);
        }

        if (empty($user->signature_image_path)) {
            return response()->json(['message' => 'QR Code TTD tidak ditemukan.'], 404);
        }

        $this->deleteExistingSignature($user->signature_image_path);

        $user->update(['signature_image_path' => null]);

        return response()->json(['message' => 'QR Code TTD berhasil dihapus.']);
    }

    private function deleteExistingSignature(?string $url): void
    {
        if (!$url) return;
        $relative = Str::of($url)->after('/storage/')->value();

        if ($relative && Storage::disk('public')->exists($relative)) {
            Storage::disk('public')->delete($relative);
        }
    }
}
