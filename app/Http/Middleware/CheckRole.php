<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Tambahkan ini agar VS Code tidak error

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Menggunakan Auth::check() dan Auth::user() alih-alih fungsi global auth()
        if (Auth::check() && in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        abort(403, 'Akses Terbatas: Anda tidak memiliki izin untuk halaman ini.');
    }
}