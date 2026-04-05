<?php

namespace App\Http\Controllers\Admin;

// Wajib mengimpor Controller utama karena posisi file ini ada di sub-folder
use App\Http\Controllers\Controller; 
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    /**
     * Menampilkan daftar semua destinasi di dashboard admin.
     */
    public function index()
    {
        $destinations = Destination::latest()->get();
        // Mengarahkan ke folder resources/views/admin/destinations/index.blade.php
        return view('admin.destinations.index', compact('destinations'));
    }

    /**
     * Menampilkan form untuk menambah destinasi baru.
     */
    public function create()
    {
        return view('admin.destinations.create');
    }

    /**
     * Menyimpan data destinasi baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'category' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        
        // Membuat slug otomatis dari nama destinasi
        $data['slug'] = Str::slug($request->name);

        // Upload Cover Image
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('destinations/covers', 'public');
        }

        // Handle Gallery (Array ke JSON)
        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('destinations/gallery', 'public');
            }
            $data['gallery'] = json_encode($galleryPaths);
        }

        // Handle Facilities (Array ke JSON)
        if ($request->has('facilities')) {
            $data['facilities'] = json_encode($request->facilities);
        }

        Destination::create($data);

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit untuk destinasi tertentu.
     */
    public function edit(Destination $destination)
    {
        // Decode data JSON agar bisa dibaca di form checkbox/gallery
        $facilities = json_decode($destination->facilities, true) ?? [];
        $gallery = json_decode($destination->gallery, true) ?? [];

        return view('admin.destinations.edit', compact('destination', 'facilities', 'gallery'));
    }

    /**
     * Memperbarui data destinasi di database.
     */
    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Update Cover Image jika ada file baru
        if ($request->hasFile('cover_image')) {
            if ($destination->cover_image) {
                Storage::disk('public')->delete($destination->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('destinations/covers', 'public');
        }

        // Update Facilities
        $data['facilities'] = json_encode($request->facilities ?? []);

        $destination->update($data);

        return redirect()->route('admin.destinations.index')->with('success', 'Data destinasi berhasil diperbarui!');
    }

    /**
     * Menghapus destinasi dari database.
     */
    public function destroy(Destination $destination)
    {
        // Hapus file gambar dari storage sebelum hapus data database
        if ($destination->cover_image) {
            Storage::disk('public')->delete($destination->cover_image);
        }

        $destination->delete();

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil dihapus!');
    }
}