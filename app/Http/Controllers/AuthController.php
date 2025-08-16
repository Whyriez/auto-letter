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

    /**
     * Show the form for creating a new resource.
     */
    public function login_process(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Menyiapkan data kredensial untuk login
        $credentials = $request->only('email', 'password');

        // 3. Menyiapkan opsi "Remember Me"
        // Menggunakan $request->boolean('remember') untuk mendapatkan nilai true/false
        $remember = $request->boolean('remember');

        // 4. Mencoba melakukan autentikasi
        if (Auth::attempt($credentials, $remember)) {
            // Jika berhasil, regenerate session untuk keamanan
            $request->session()->regenerate();

            // 5. Ambil data user yang sedang login
            $user = Auth::user();

            // 6. Arahkan berdasarkan role user
            switch ($user->role) {
                case 'super_admin':
                    return redirect()->route('super_admin.dashboard');
                case 'admin_jurusan':
                    return redirect()->route('admin_jurusan.dashboard');
                case 'kajur':
                    return redirect()->route('kajur.dashboard');
                case 'kaprodi':
                    return redirect()->route('kaprodi.dashboard');
                case 'mahasiswa':
                    return redirect()->route('mahasiswa.dashboard');
                default:
                    // Jika role tidak dikenali, arahkan ke halaman login
                    return redirect('/login');
            }
        }

        // 7. Jika autentikasi gagal
        // Kembalikan ke halaman login dengan pesan error
        return back()->with('flash.error', 'Email or Password is Incorrect');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
