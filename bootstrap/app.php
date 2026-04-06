<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // DI SINI TEMPAT MENDAFTARKAN ALIAS
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
    }) // <-- Pastikan tutup kurung ini benar
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create(); // <-- Titik koma HANYA ada di paling akhir setelah create()