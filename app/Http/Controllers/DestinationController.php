<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    // Halaman Daftar Destinasi (Jelajah)
    public function index(Request $request)
    {
        $query = Destination::query();

        // Filter Kategori
        if ($request->filled('category') && $request->category != 'Semua') {
            $query->where('category', $request->category);
        }

        // Search Nama/Lokasi
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
            });
        }

        $destinations = $query->latest()->get();
        return view('visitor.index_destinasi', compact('destinations'));
    }

    // Halaman Detail Destinasi
    public function show($slug)
    {
        $destination = Destination::where('slug', $slug)->firstOrFail();
        
        // Handle JSON untuk gallery dan facilities
        $gallery = is_array($destination->gallery) 
                    ? $destination->gallery 
                    : json_decode($destination->gallery, true) ?? [];

        $facilities = is_array($destination->facilities) 
                    ? $destination->facilities 
                    : json_decode($destination->facilities, true) ?? [];

        return view('visitor.show', compact('destination', 'gallery', 'facilities'));
    }
}