<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;

class SuperAdminController extends Controller
{

    public function index(Request $request)
    {
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalActiveUsers = User::where('status', 'active')->count();
        $totalInactiveUsers = User::where('status', 'inactive')->count();
        $totalSuspendedUsers = User::where('is_suspend', 1)->count();
        return view('admin.super.index', compact('totalMahasiswa', 'totalActiveUsers', 'totalInactiveUsers', 'totalSuspendedUsers'));
    }
    public function user(Request $request)
    {
        $query = User::orderBy('created_at', 'asc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('nim_nip', 'like', '%' . $search . '%')
                    ->orWhere('jurusan', 'like', '%' . $search . '%')
                    ->orWhere('prodi', 'like', '%' . $search . '%');
            });
        }


        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status')) {
            // Asumsikan status adalah enum: 'active' = 0 (aktif), 'inactive' = 1 (suspend)
            $statusMap = [
                'active' => 0,   // aktif
                'inactive' => 1, // suspend
            ];
            if (isset($statusMap[$request->status])) {
                $query->where('is_suspend', $statusMap[$request->status]);
            }
        }

        $users = $query->paginate(10)->withQueryString();



        return view('admin.super.users', compact('users'));
    }



    public function submit_new_user(Request $request)
    {
        // 1. Validasi dasar untuk semua field yang mungkin diisi.
        // Aturan 'nullable' digunakan agar validasi tidak gagal jika field dikosongkan.
        $validatedData = $request->validate([
            'user-name' => ['required', 'string', 'max:255'],
            'user-email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'user-role' => ['required', 'string', Rule::in(['super_admin', 'admin_jurusan', 'kaprodi', 'kajur', 'mahasiswa'])],
            'user-status' => ['required', 'string'],
            'password' => ['required', 'string'],
            'nim_nip' => ['nullable', 'string', 'max:255', 'unique:users,nim_nip'],
            'jurusan' => ['nullable', 'string', 'max:255'],
            'prodi' => ['nullable', 'string', 'max:255'],
        ], [
            'user-email.unique' => 'Email ini sudah terdaftar.',
            'nim_nip.unique' => 'NIM/NIP ini sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.'
        ]);

        try {
            // 2. Persiapan Data Final berdasarkan Role (Logika Bisnis)
            $role = $validatedData['user-role'];

            // Mulai dengan data yang selalu ada
            $userData = [
                'name' => $validatedData['user-name'],
                'email' => $validatedData['user-email'],
                'role' => $role,
                'status' => $validatedData['user-status'],
                'password' => Hash::make($validatedData['password']),
            ];

            // Terapkan aturan berdasarkan role
            switch ($role) {
                case 'mahasiswa':
                case 'kaprodi':
                    // Semua field identitas wajib ada, ambil dari data tervalidasi
                    $userData['nim_nip'] = $validatedData['nim_nip'];
                    $userData['jurusan'] = $validatedData['jurusan'];
                    $userData['prodi'] = $validatedData['prodi'];
                    break;

                case 'kajur':
                case 'admin_jurusan':
                    // NIP dan Jurusan wajib, tapi Prodi HARUS NULL
                    $userData['nim_nip'] = $validatedData['nim_nip'];
                    $userData['jurusan'] = $validatedData['jurusan'];
                    $userData['prodi'] = null; // Paksa jadi NULL
                    break;

                case 'super_admin':
                default:
                    // Untuk Super Admin atau role lain, semua field identitas HARUS NULL
                    $userData['nim_nip'] = null;
                    $userData['jurusan'] = null;
                    $userData['prodi'] = null;
                    break;
            }

            // 3. Buat user dengan data yang sudah bersih
            $user = User::create($userData);

            $notification = [
                'message' => 'Pengguna "' . $user->name . '" berhasil dibuat!',
                'type' => 'success'
            ];

            return redirect()->route('super_admin.users')->with('notification', $notification);
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Terjadi kesalahan pada server, pengguna gagal dibuat.',
                'type' => 'error'
            ];

            return back()->with('notification', $notification)->withInput();
        }
    }

    public function show_user($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update_user(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi dasar
        $validatedData = $request->validate([
            'user-name'   => ['required', 'string', 'max:255'],
            'user-email'  => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'user-role'   => ['required', 'string', Rule::in(['super_admin', 'admin_jurusan', 'kaprodi', 'kajur', 'mahasiswa'])],
            'user-status' => ['required', 'string'],
            'password'    => ['nullable', 'string'],
            'nim_nip'     => ['nullable', 'string', 'max:255', Rule::unique('users', 'nim_nip')->ignore($user->id)],
            'jurusan'     => ['nullable', 'string', 'max:255'],
            'prodi'       => ['nullable', 'string', 'max:255'],
        ], [
            'user-email.unique' => 'Email ini sudah terdaftar.',
            'nim_nip.unique'    => 'NIM/NIP ini sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.'
        ]);

        try {
            $role = $validatedData['user-role'];

            // Data umum
            $updateData = [
                'name'   => $validatedData['user-name'],
                'email'  => $validatedData['user-email'],
                'role'   => $role,
                'status' => $validatedData['user-status'],
            ];

            // Password hanya diupdate kalau diisi
            if (!empty($validatedData['password'])) {
                $updateData['password'] = Hash::make($validatedData['password']);
            }

            // Aturan berdasarkan role
            switch ($role) {
                case 'mahasiswa':
                case 'kaprodi':
                    $updateData['nim_nip'] = $validatedData['nim_nip'];
                    $updateData['jurusan'] = $validatedData['jurusan'];
                    $updateData['prodi']   = $validatedData['prodi'];
                    break;

                case 'kajur':
                case 'admin_jurusan':
                    $updateData['nim_nip'] = $validatedData['nim_nip'];
                    $updateData['jurusan'] = $validatedData['jurusan'];
                    $updateData['prodi']   = null; // prodi harus null
                    break;

                case 'super_admin':
                default:
                    $updateData['nim_nip'] = null;
                    $updateData['jurusan'] = null;
                    $updateData['prodi']   = null;
                    break;
            }

            $user->update($updateData);

            $notification = [
                'message' => 'Pengguna "' . $user->name . '" berhasil diperbarui!',
                'type'    => 'success'
            ];

            return redirect()->route('super_admin.users')->with('notification', $notification);
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Terjadi kesalahan pada server, pengguna gagal diperbarui.',
                'type'    => 'error'
            ];

            return back()->with('notification', $notification)->withInput();
        }
    }


    public function delete_user($id)
    {
        $user  = User::findOrFail($id);
        $username = $user->name;
        $user->delete();

        $notification = [
            'message' => 'Pengguna ' . $username . ' telah dihapus!',
            'type' => 'success'
        ];

        return redirect()->route('super_admin.users')->with('notification', $notification);
    }

    public function toggleSuspend(Request $request, $id)
    {
        // Validasi input untuk memastikan nilainya hanya 0 atau 1
        $validated = $request->validate([
            'is_suspend' => ['required', Rule::in([0, 1])],
        ]);

        try {
            $user = User::findOrFail($id);

            // Perbarui kolom 'is_suspend' berdasarkan nilai dari form
            $user->is_suspend = $validated['is_suspend'];
            $user->save();

            $statusText = $user->is_suspend ? 'diblokir' : 'diaktifkan';

            $notification = [
                'message' => 'Pengguna "' . $user->name . '" telah berhasil ' . $statusText . '!',
                'type' => 'success'
            ];

            return back()->with('notification', $notification);
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Gagal mengubah status pengguna.',
                'type' => 'error'
            ];

            return back()->with('notification', $notification);
        }
    }

    public function updateRole(Request $request, $id)
    {
        // Validasi untuk memastikan role yang dikirim adalah salah satu dari opsi yang valid
        $validated = $request->validate([
            'role' => ['required', Rule::in(['super_admin', 'admin_jurusan', 'kaprodi', 'kajur', 'mahasiswa'])],
        ]);

        try {
            $user = User::findOrFail($id);
            $user->role = $validated['role'];
            $user->save();

            // Kirim respons sukses dalam format JSON
            return response()->json(['message' => 'Peran untuk ' . $user->name . ' telah berhasil diubah!']);
        } catch (\Exception $e) {
            // Kirim respons error jika gagal
            return response()->json(['message' => 'Gagal mengubah peran.'], 500);
        }
    }
}
