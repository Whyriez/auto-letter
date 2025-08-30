<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ForceSignatureQr
{
    /**
     * Route NAME yang tetap boleh diakses walau belum upload QR.
     * Gunakan nama route (bukan path). Wildcard didukung via routeIs().
     */
    private array $allowedRouteNames = [
        'dashboard.setting',          // GET halaman setting
        'dashboard.setting.update',   // PUT update profile
        'profile.ttd_qr.destroy',     // DELETE hapus QR
        // Auth & verifikasi (opsional)
        'login',
        'logout',
        'password.*',
        'verification.*',
        'register',
    ];

    /**
     * Prefix PATH statik yang aman diakses (asset, storage link, dsb).
     * Biasanya tidak lewat group 'web', tapi kita sediakan just-in-case.
     */
    private array $allowedPathGlobs = [
        'storage/*',
        'assets/*',
        'build/*',
        'dist/*',
        'css/*',
        'js/*',
        'images/*',
        'vendor/*',
    ];

    public function handle(Request $request, Closure $next)
    {
        // Hanya cek bila user sudah login
        $user = $request->user();
        if (!$user) {
            return $next($request);
        }

        // Wajibkan hanya untuk kajur/kaprodi
        if (!in_array($user->role, ['kajur', 'kaprodi'])) {
            return $next($request);
        }

        // Jika sudah punya QR → lanjut
        if (filled($user->signature_image_path)) {
            return $next($request);
        }

        // Izinkan route yang dikecualikan
        if ($this->isAllowed($request)) {
            return $next($request);
        }

        // Untuk request JSON/AJAX
        if ($request->expectsJson()) {
            return response()->json([
                'message'  => 'Harap unggah QR TTD terlebih dahulu di halaman Pengaturan Profil.',
                'redirect' => route('dashboard.setting'),
            ], 403);
        }

        // Simpan intended URL agar bisa kembali setelah upload
        if ($request->isMethod('GET')) {
            session()->put('url.intended', $request->fullUrl());
        }

        // Redirect paksa ke halaman setting
        return redirect()
            ->route('dashboard.setting')
            ->with('notification', [
                'message' => 'Untuk melanjutkan, unggah QR Code TTD Anda terlebih dahulu.',
                'type'    => 'red',
            ]);
    }

    private function isAllowed(Request $request): bool
    {
        // Cek nama route (mendukung wildcard: 'password.*', 'verification.*')
        if ($request->routeIs($this->allowedRouteNames)) {
            return true;
        }

        // Cek path statik (asset)
        $path = ltrim($request->path(), '/');
        foreach ($this->allowedPathGlobs as $glob) {
            if (Str::is($glob, $path)) {
                return true;
            }
        }

        return false;
    }
}
