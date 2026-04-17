<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    /**
     * Field yang boleh diisi secara massal.
     * Kita tambahkan 'category_id' untuk menggantikan 'category' (string) yang lama.
     */
    protected $fillable = [
        'name', 
        'slug', 
        'location', 
        'category_id', // Gunakan ID untuk relasi ke tabel categories
        'description', 
        'price', 
        'cover_image', 
        'gallery', 
        'facilities'
    ];

    /**
     * Casting data JSON/Array agar otomatis menjadi array saat dipanggil di Controller/Blade.
     */
    protected $casts = [
        'gallery' => 'array',
        'facilities' => 'array',
        'price' => 'integer',       
    ];

    /**
     * RELASI: Menghubungkan Destinasi ke Kategori.
     * (Satu Destinasi memiliki satu Kategori)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}