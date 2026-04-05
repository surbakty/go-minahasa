<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    // Mengizinkan semua kolom diisi
    protected $guarded = []; 

    // Memberitahu Laravel bahwa kolom 'gallery' adalah array (JSON)
    protected $casts = [
        'gallery' => 'array',
        'facilities' => 'array',
    ];

    protected $fillable = ['name', 'slug', 'location', 'category', 'description', 'price', 'cover_image', 'gallery', 'facilities'];
}