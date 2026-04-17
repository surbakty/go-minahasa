<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\Post; // Jika nanti ingin menampilkan blog terbaru juga
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        // Ambil testimoni terbaru
        $testimonials = Testimonial::latest()->get();

        // Kirim ke view landing page
        return view('visitor.landing', compact('testimonials'));
    }
}