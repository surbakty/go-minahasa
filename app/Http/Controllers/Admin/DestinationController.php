<?php

namespace App\Http\Controllers\Admin;

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
        // Validasi: cover_image wajib (required) saat tambah baru
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'category' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'cover_image' => 'required|image|max:2048', // Semua format gambar diizinkan
            'gallery.*' => 'image|max:2048', // Validasi tiap file di gallery
        ]);

        $data = $request->all();
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
        $facilities = json_decode($destination->facilities, true) ?? [];
        $gallery = json_decode($destination->gallery, true) ?? [];

        return view('admin.destinations.edit', compact('destination', 'facilities', 'gallery'));
    }

    /**
     * Memperbarui data destinasi di database.
     */
    public function update(Request $request, Destination $destination)
    {
        // Validasi: cover_image bersifat nullable saat update
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'category' => 'required', // Tambahkan agar tidak hilang saat update
            'price' => 'required|numeric',
            'description' => 'required',
            'cover_image' => 'nullable|image|max:2048', // Opsional, jika mau ganti saja
            'gallery.*' => 'image|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Update Cover Image jika ada file baru
        if ($request->hasFile('cover_image')) {
            // Hapus foto lama jika ada
            if ($destination->cover_image) {
                Storage::disk('public')->delete($destination->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('destinations/covers', 'public');
        }

        // Update Gallery (Logika sederhana: ganti semua jika ada upload baru)
        if ($request->hasFile('gallery')) {
            // Hapus gallery lama dari storage
            $oldGallery = json_decode($destination->gallery, true) ?? [];
            foreach ($oldGallery as $oldFile) {
                Storage::disk('public')->delete($oldFile);
            }

            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('destinations/gallery', 'public');
            }
            $data['gallery'] = json_encode($galleryPaths);
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
        if ($destination->cover_image) {
            Storage::disk('public')->delete($destination->cover_image);
        }

        // Hapus juga file gallery saat destinasi dihapus
        $gallery = json_decode($destination->gallery, true) ?? [];
        foreach ($gallery as $file) {
            Storage::disk('public')->delete($file);
        }

        $destination->delete();

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil dihapus!');
    }
}