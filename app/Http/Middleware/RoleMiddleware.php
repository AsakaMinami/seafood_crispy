<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // 1. Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect('login');
        }

        // 2. Ambil peran pengguna yang sedang login
        $userRole = Auth::user()->role->name;

        // 3. Cek apakah peran pengguna ada di dalam daftar peran yang diizinkan
        if (!in_array($userRole, $roles)) {
            // Jika tidak, alihkan ke halaman 'home' dengan pesan error
            return redirect('home')->with('error', 'Akses ditolak!');
        }

        // 4. Jika peran diizinkan, lanjutkan ke halaman yang dituju
        return $next($request);
    }
}
