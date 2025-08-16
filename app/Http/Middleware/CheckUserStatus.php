<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah ada pengguna yang sedang login
        if (Auth::check()) {
            $user = Auth::user();

            // 2. Cek jika statusnya inactive atau di-suspend
            if ($user->status === 'inactive' || $user->is_suspend) {
                // Simpan pesan error sebelum logout
                $message = $user->is_suspend ? 'Your account has been suspended.' : 'Your account has been deactivated.';

                // 3. Jika salah satu kondisi terpenuhi, paksa logout
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                // 4. Arahkan ke halaman login dengan pesan error
                return redirect('/login')->with('flash.error', $message);
            }
        }

        // 5. Jika status user aman, lanjutkan ke halaman yang dituju
        return $next($request);
    }
}
