<?php

use Illuminate\Support\Facades\Route;

// Import Controller dengan Namespace yang tepat
use App\Http\Controllers\Visitor\LandingPageController;
use App\Http\Controllers\DestinationController; // Controller Publik (di folder utama)
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController; // Controller Admin (di folder Admin)

/*
|--------------------------------------------------------------------------
| Web Routes - Go Minahasa
|--------------------------------------------------------------------------
*/

// ==========================================
// --- BAGIAN PENGUNJUNG (VISITOR) ---
// ==========================================

// 1. Halaman Landing (Beranda)
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

// 2. Daftar Destinasi (Jelajah)
// Gunakan 'destinations.index' agar konsisten dengan standar Laravel
Route::get('/destinasi', [DestinationController::class, 'index'])->name('destinations.index');

// 3. Detail Destinasi (Dinamis berdasarkan Slug)
Route::get('/destinasi/{slug}', [DestinationController::class, 'show'])->name('destinations.show');

// 4. Halaman Statis
Route::get('/tentang-kami', function () {
    return view('visitor.about');
})->name('about');


// ==========================================
// --- BAGIAN ADMIN (Go-Minahasa PANEL) ---
// ==========================================

Route::prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Utama Admin
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Mengelola Semua Fitur Destinasi (CRUD)
    // Nama rute otomatis menjadi: admin.destinations.index, admin.destinations.create, dll.
    Route::resource('destinations', AdminDestinationController::class);
    
});