<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    public function login_process(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            if ($user->status === 'inactive') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                $notification = [
                    'message' => 'Akun anda telah dinonaktifkan',
                    'type' => 'error',
                ];
                return back()->with('notification', $notification);
            }

            if ($user->is_suspend) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                $notification = [
                    'message' => 'Akun anda telah disuspend, silahkan hubungi admin.',
                    'type' => 'error',
                ];
                return back()->with('notification', $notification);
            }

            $request->session()->regenerate();

            $notification = [
                'message' => 'Login berhasil selamat datang kembali!',
                'type' => 'success',
            ];
            switch ($user->role) {
                case 'super_admin':
                    return redirect()->route('super_admin.dashboard')->with('notification', $notification);
                case 'admin_jurusan':
                    return redirect()->route('admin_jurusan.dashboard')->with('notification', $notification);
                case 'kajur':
                    return redirect()->route('kajur.index')->with('notification', $notification);
                case 'kaprodi':
                    return redirect()->route('kaprodi.index')->with('notification', $notification);
                case 'mahasiswa':
                    return redirect()->route('mahasiswa.index')->with('notification', $notification);
                default:
                    Auth::logout();
                    $notification = [
                        'message' => 'akun tidak ditemukan',
                        'type' => 'error',
                    ];
                    return redirect('/login')->with('notification', $notification);
            }
        }

        $notification = [
            'message' => 'Email atau password salah.',
            'type' => 'error',
        ];
        return back()->with('notification', $notification);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $notification = [
            'message' => 'Anda telah berhasil keluar.',
            'type' => 'success',
        ];
        return redirect('/login')->with('notification', $notification);
    }
}
