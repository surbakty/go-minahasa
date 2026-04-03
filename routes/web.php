<?php

use App\Http\Controllers\Visitor\LandingPageController;
use App\Http\Controllers\Admin\DestinationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Go Minahasa
|--------------------------------------------------------------------------
*/

// --- Bagian Pengunjung (Visitor) ---
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

Route::get('/destinasi', function () {
    return view('visitor.index_destinasi'); 
})->name('destinasi.index');

// Route Statis untuk Dummy Detail
Route::get('/destination/bunaken', function () {
    return view('visitor.show'); 
})->name('destination.bunaken');

// Route Dinamis
Route::get('/destination/{slug}', [LandingPageController::class, 'show'])->name('destination.show');

Route::get('/tentang-kami', function () {
    return view('visitor.about');
})->name('about');


// --- Bagian Admin (Manual Admin, Bukan Filament) ---
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Halaman Dashboard Utama
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Mengelola Semua Fitur Destinasi (CRUD)
    Route::resource('destinations', DestinationController::class);
    
});