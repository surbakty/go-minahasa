<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // 1. Cek apakah user sudah login
        // 2. Cek apakah role user sesuai dengan yang diminta di route
        if (!$request->user() || $request->user()->role !== $role) {
            // Jika tidak sesuai, arahkan ke dashboard dengan pesan error
            return redirect()->route('admin.dashboard')->with('error', 'Akses Ditolak! Anda bukan ' . $role);
        }

        return $next($request);
    }
}