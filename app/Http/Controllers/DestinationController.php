<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 

class DestinationController extends Controller
{
    /**
     * Halaman Daftar Destinasi (Jelajah) dengan Filter & Search
     */
    public function index(Request $request)
    {
        // Mengambil query dasar dengan Eager Loading relasi category agar ringan
        $query = Destination::with('category');

        // 1. Filter berdasarkan Kategori menggunakan Relasi whereHas
        if ($request->has('category') && $request->category != 'Semua' && $request->category != '') {
            $categoryName = $request->category;
            
            $query->whereHas('category', function($q) use ($categoryName) {
                $q->where('name', $categoryName);
            });
        }

        // 2. Filter berdasarkan Pencarian (Nama atau Lokasi)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%');
            });
        }

        // Ambil hasil terbaru
        $destinations = $query->latest()->get();

        // Mengembalikan view ke folder visitor/destinations/index.blade.php
        return view('visitor.destinations.index', compact('destinations'));
    }

    /**
     * Halaman Detail Destinasi
     */
    public function show($slug)
    {
        // Ambil data berdasarkan slug
        $destination = Destination::with('category')->where('slug', $slug)->firstOrFail();
        
        // Proteksi Array: Mengubah string JSON lama atau null menjadi array agar tidak crash di Blade
        $gallery = is_array($destination->gallery) 
                    ? $destination->gallery 
                    : (json_decode($destination->gallery, true) ?? []);

        $facilities = is_array($destination->facilities) 
                    ? $destination->facilities 
                    : (json_decode($destination->facilities, true) ?? []);

        return view('visitor.show', compact('destination', 'gallery', 'facilities'));
    }
}