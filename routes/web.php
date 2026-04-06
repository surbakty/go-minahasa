<?php

use Illuminate\Support\Facades\Route;

// Import Controller Visitor
use App\Http\Controllers\Visitor\LandingPageController;
use App\Http\Controllers\DestinationController as PublicDestinationController;

// Import Controller Admin & Auth
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\DashboardController; 
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes - Go Minahasa
|--------------------------------------------------------------------------
*/

// ==========================================
// --- BAGIAN PENGUNJUNG (VISITOR) ---
// ==========================================
Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::get('/destinasi', [PublicDestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinasi/{slug}', [PublicDestinationController::class, 'show'])->name('destinations.show');

Route::get('/tentang-kami', function () {
    return view('visitor.about');
})->name('about');

Route::get('/pusat-bantuan', function () {
    return view('visitor.help');
})->name('help');

Route::get('/syarat-ketentuan', function () {
    return view('visitor.terms');
})->name('terms');

Route::get('/kebijakan-privasi', function () {
    return view('visitor.privacy');
})->name('privacy');


// ==========================================
// --- BAGIAN AUTENTIKASI (LOGIN/LOGOUT) ---
// ==========================================
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==========================================
// --- BAGIAN ADMIN (DIPROTEKSI ROLE) ---
// ==========================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // 1. Dashboard: Bisa diakses oleh semua (Admin & Editor)
    // Sekarang memanggil DashboardController agar data Statistik otomatis terhitung
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Kelola Destinasi: Bisa diakses oleh semua (Admin & Editor)
    Route::resource('destinations', AdminDestinationController::class);

    // 3. Area Khusus ADMINISTRATOR (Felix)
    // Gunakan middleware 'role:admin' yang sudah kita daftarkan sebelumnya
    Route::middleware(['role:admin'])->group(function () {
        
    Route::middleware(['role:admin'])->group(function () {
        // Rute untuk kelola staff/user
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    });
        // Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        // Route::resource('users', UserController::class)->name('users');
    });
}); 