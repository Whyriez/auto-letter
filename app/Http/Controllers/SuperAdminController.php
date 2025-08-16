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
        $query = User::orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
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

        $users = $query->paginate(5)->withQueryString();

        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalActiveUsers = User::where('status', 'active')->count();
        $totalInactiveUsers = User::where('status', 'inactive')->count();
        $totalSuspendedUsers = User::where('is_suspend', 1)->count();

        return view('admin.super.index', compact('users', 'totalMahasiswa', 'totalActiveUsers', 'totalInactiveUsers', 'totalSuspendedUsers'));
    }


    public function submit_new_user(Request $request)
    {

        $validatedData = $request->validate([
            'user-name' => ['required', 'string', 'max:255'],
            'user-email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'user-role' => ['required', 'string'],
            'user-status' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'user-email.unique' => 'Email has already been taken.'
        ]);
        try {
            $user = User::create([
                'name' => $validatedData['user-name'],
                'email' => $validatedData['user-email'],
                'role' => $validatedData['user-role'],
                'status' => $validatedData['user-status'],
                'password' => Hash::make($validatedData['password']),
            ]);

            $notification = [
                'message' => 'User "' . $user->name . '" berhasil dibuat!',
                'type' => 'success'
            ];

            return redirect()->route('super_admin.dashboard')->with('notification', $notification);
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Terjadi kesalahan pada server, user gagal dibuat.' . $e->getMessage(),
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
            'user-name' => ['required', 'string', 'max:255'],
            'user-email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'user-role' => ['required', 'string'],
            'user-status' => ['required', 'string'],
            'password' => ['nullable', 'string'], // Ubah jadi confirmed jika perlu
        ], [
            'user-email.unique' => 'Email has already been taken.'
        ]);

        $updateData = [
            'name' => $validatedData['user-name'],
            'email' => $validatedData['user-email'],
            'role' => $validatedData['user-role'],
            'status' => $validatedData['user-status'],
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($updateData);

        $notification = [
            'message' => 'User ' . $user->name . ' have been updated!',
            'type' => 'success'
        ];

        return redirect()->route('super_admin.dashboard')->with('notification', $notification);
    }

    public function delete_user($id)
    {
        $user  = User::findOrFail($id);
        $username = $user->name;
        $user->delete();

        $notification = [
            'message' => 'User ' . $username . ' has been deleted!',
            'type' => 'success'
        ];

        return redirect()->route('super_admin.dashboard')->with('notification', $notification);
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

            $statusText = $user->is_suspend ? 'suspended' : 'unsuspended';

            $notification = [
                'message' => 'User "' . $user->name . '" has been successfully ' . $statusText . '!',
                'type' => 'success'
            ];

            return back()->with('notification', $notification);
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Failed to change user status.',
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
            return response()->json(['message' => 'Role for ' . $user->name . ' has been changed successfully!']);
        } catch (\Exception $e) {
            // Kirim respons error jika gagal
            return response()->json(['message' => 'Failed to change role.'], 500);
        }
    }
}
