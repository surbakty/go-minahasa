<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Illuminate\Database\Schema\Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('author')->nullable(); // Nama penulis
                $table->string('cover_image');      // Foto utama artikel
                $table->text('excerpt');            // Ringkasan pendek artikel
                $table->longText('body');           // Isi lengkap artikel
                $table->string('category')->nullable(); // Kategori artikel (misal: Tips, Berita)
                $table->integer('views')->default(0);   // Untuk melihat jumlah pembaca
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
