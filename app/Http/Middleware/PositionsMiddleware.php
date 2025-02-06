<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PositionsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$positions)
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil posisi pengguna dari kolom `position`
        $userPosition = Auth::user()->position_id;

        // Konversi semua nilai $positions ke integer
        $positions = array_map('intval', $positions);

        // Cek apakah posisi pengguna termasuk dalam daftar posisi yang diizinkan
        // if (!in_array($userPosition, $positions)) {
        //     return abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        // }
        if (!in_array($userPosition, $positions)) {
            return abort(403, 'Anda tidak memiliki akses ke halaman ini. Posisi Anda: ' . $userPosition . ', Posisi yang diizinkan: ' . implode(', ', $positions));
        }

        return $next($request);
    }
}
