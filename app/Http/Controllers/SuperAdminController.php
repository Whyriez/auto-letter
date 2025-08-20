<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $rawRoleCounts = User::select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->pluck('count', 'role')
            ->toArray();

        $roles = ['mahasiswa', 'admin_jurusan', 'kaprodi', 'kajur'];
        $roleCounts = collect($roles)
            ->mapWithKeys(fn($r) => [$r => $rawRoleCounts[$r] ?? 0])
            ->all();

        return view('admin.super.index', compact('totalMahasiswa', 'totalActiveUsers', 'totalInactiveUsers', 'totalSuspendedUsers', 'roleCounts'));
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
            $statusMap = [
                'active' => 0,  
                'inactive' => 1,
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
            $role = $validatedData['user-role'];
            $userData = [
                'name' => $validatedData['user-name'],
                'email' => $validatedData['user-email'],
                'role' => $role,
                'status' => $validatedData['user-status'],
                'password' => Hash::make($validatedData['password']),
            ];

            switch ($role) {
                case 'mahasiswa':
                case 'kaprodi':
                    $userData['nim_nip'] = $validatedData['nim_nip'];
                    $userData['jurusan'] = $validatedData['jurusan'];
                    $userData['prodi'] = $validatedData['prodi'];
                    break;

                case 'kajur':
                case 'admin_jurusan':
                    $userData['nim_nip'] = $validatedData['nim_nip'];
                    $userData['jurusan'] = $validatedData['jurusan'];
                    $userData['prodi'] = null; 
                    break;

                case 'super_admin':
                default:
                    $userData['nim_nip'] = null;
                    $userData['jurusan'] = null;
                    $userData['prodi'] = null;
                    break;
            }

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

            $updateData = [
                'name'   => $validatedData['user-name'],
                'email'  => $validatedData['user-email'],
                'role'   => $role,
                'status' => $validatedData['user-status'],
            ];

            if (!empty($validatedData['password'])) {
                $updateData['password'] = Hash::make($validatedData['password']);
            }

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
                    $updateData['prodi']   = null; 
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
        $validated = $request->validate([
            'is_suspend' => ['required', Rule::in([0, 1])],
        ]);

        try {
            $user = User::findOrFail($id);

            if ($user->role === 'super_admin') {
                return back()->with('notification', [
                    'message' => 'Super Admin tidak dapat diblokir atau disuspend.',
                    'type' => 'error'
                ]);
            }

            $user->is_suspend = $validated['is_suspend'];
            $user->save();

            $statusText = $user->is_suspend ? 'diblokir' : 'diaktifkan';

            return back()->with('notification', [
                'message' => 'Pengguna "' . $user->name . '" telah berhasil ' . $statusText . '!',
                'type' => 'success'
            ]);
        } catch (\Exception $e) {
            return back()->with('notification', [
                'message' => 'Gagal mengubah status pengguna.',
                'type' => 'error'
            ]);
        }
    }

    public function updateRole(Request $request, $id)
    {
        $validated = $request->validate([
            'role' => ['required', Rule::in(['super_admin', 'admin_jurusan', 'kaprodi', 'kajur', 'mahasiswa'])],
        ]);

        try {
            $user = User::findOrFail($id);
            $user->role = $validated['role'];
            $user->save();

            return response()->json(['message' => 'Peran untuk ' . $user->name . ' telah berhasil diubah!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal mengubah peran.'], 500);
        }
    }
}
