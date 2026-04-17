<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Testimonial;
use App\Models\Gallery; // Import model Gallery
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // 1. Ambil data destinasi dengan kategorinya
        $destinations = Destination::with('category')->latest()->get();

        // 2. Ambil data testimoni terbaru
        $testimonials = Testimonial::latest()->get();

        // 3. Ambil 6 foto galeri terbaru yang statusnya aktif
        $galleries = Gallery::where('is_active', true)->latest()->take(6)->get();

        // 4. Kirim semua data ke view visitor.landing
        return view('visitor.landing', compact('destinations', 'testimonials', 'galleries'));
    }

    public function show($slug)
    {
        // Fungsi detail destinasi tetap dipertahankan
        $destination = Destination::with('category')->where('slug', $slug)->firstOrFail();

        return view('visitor.show', compact('destination'));
    }
}