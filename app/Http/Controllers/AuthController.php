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

                return back()->with('flash.error', 'Your account has been deactivated.');
            }

            if ($user->is_suspend) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->with('flash.error', 'Your account has been suspended.');
            }

            $request->session()->regenerate();

            switch ($user->role) {
                case 'super_admin':
                    return redirect()->route('super_admin.dashboard');
                case 'admin_jurusan':
                    return redirect()->route('admin_jurusan.dashboard');
                case 'kajur':
                    return redirect()->route('kajur.index');
                case 'kaprodi':
                    return redirect()->route('kaprodi.index');
                case 'mahasiswa':
                    return redirect()->route('mahasiswa.index');
                default:
                    Auth::logout();
                    return redirect('/login')->with('flash.error', 'Invalid role.');
            }
        }

        return back()->with('flash.error', ' email or password is incorrect.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('flash.success', 'You have been logged out successfully.');
    }
}
