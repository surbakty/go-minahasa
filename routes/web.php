<?php

use Illuminate\Support\Facades\Route;

// Import Controller Visitor
use App\Http\Controllers\Visitor\LandingPageController;
use App\Http\Controllers\DestinationController as PublicDestinationController;
use App\Http\Controllers\BlogController;

// Import Controller Admin & Auth
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
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

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Halaman Statis
Route::view('/tentang-kami', 'visitor.about')->name('about');
Route::view('/pusat-bantuan', 'visitor.help')->name('help');
Route::view('/syarat-ketentuan', 'visitor.terms')->name('terms');
Route::view('/kebijakan-privasi', 'visitor.privacy')->name('privacy');


// ==========================================
// --- BAGIAN AUTENTIKASI ---
// ==========================================
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// ==========================================
// --- BAGIAN ADMIN (DIPROTEKSI ROLE) ---
// ==========================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // --- GRUP 1: Akses untuk ADMIN & EDITOR ---
    // Editor hanya bisa mengelola konten wisatanya saja
    Route::middleware(['role:admin,editor'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::resource('destinations', AdminDestinationController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('posts', PostController::class);
        Route::resource('galleries', AdminGalleryController::class);
    });

    // --- GRUP 2: Akses KHUSUS ADMINISTRATOR (Felix) ---
    // Editor akan kena 403 jika mencoba mengakses route di bawah ini
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('testimonials', TestimonialController::class);
        
        // Anda bisa menambahkan route Setting di sini nanti
        // Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    });
});