<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Destination;

class LandingPageController extends Controller
{
    public function index()
    {
        $destinations = Destination::all();
        return view('visitor.landing', compact('destinations'));
    }

    public function show($slug)
    {
        // Mencari destinasi berdasarkan slug agar URL lebih SEO friendly
        $destination = Destination::where('slug', $slug)->firstOrFail();
        
        return view('visitor.show', compact('destination'));
    }
}