<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk mengizinkan kolom-kolom ini diisi
    protected $fillable = [
        'title',
        'image',
        'is_active'
    ];
}