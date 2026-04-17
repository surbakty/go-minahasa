<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Field yang boleh diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Jika kamu ingin menghubungkan kategori ke destinasi nantinya (Relasi)
     */
    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }
}