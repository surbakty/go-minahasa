<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\Destination;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    public function index()
    {
        // Eager Loading 'category' untuk menghindari N+1 Query
        $destinations = Destination::with('category')->latest()->get();
        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.destinations.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'required',
            'cover_image' => 'required|image|max:2048',
            'gallery.*' => 'image|max:2048',
        ]);

        $data = $request->except(['cover_image', 'gallery']);
        $data['slug'] = Str::slug($request->name);
        $data['facilities'] = $request->facilities ?? [];

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('destinations/covers', 'public');
        }

        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('destinations/gallery', 'public');
            }
            $data['gallery'] = $galleryPaths; 
        }

        Destination::create($data);

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil ditambahkan!');
    }

    /**
     * Menampilkan halaman edit dengan proteksi array pada facilities agar tidak TypeError
     */
    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        $categories = Category::all(); 

        // Paksa menjadi array agar in_array() di view tidak error
        $currentFacilities = is_array($destination->facilities) 
            ? $destination->facilities 
            : (json_decode($destination->facilities, true) ?? []);

        return view('admin.destinations.edit', compact('destination', 'categories', 'currentFacilities'));
    }

    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'required',
            'cover_image' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['cover_image', 'gallery']);
        $data['slug'] = Str::slug($request->name);
        $data['facilities'] = $request->facilities ?? [];

        if ($request->hasFile('cover_image')) {
            if ($destination->cover_image && Storage::disk('public')->exists($destination->cover_image)) {
                Storage::disk('public')->delete($destination->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('destinations/covers', 'public');
        }

        if ($request->hasFile('gallery')) {
            // Gunakan proteksi array saat menghapus file fisik lama
            $oldGalleries = is_array($destination->gallery) 
                ? $destination->gallery 
                : (json_decode($destination->gallery, true) ?? []);

            if (!empty($oldGalleries)) {
                foreach ($oldGalleries as $oldFile) {
                    if (Storage::disk('public')->exists($oldFile)) {
                        Storage::disk('public')->delete($oldFile);
                    }
                }
            }

            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('destinations/gallery', 'public');
            }
            $data['gallery'] = $galleryPaths;
        }

        $destination->update($data);

        return redirect()->route('admin.destinations.index')->with('success', 'Data destinasi berhasil diperbarui!');
    }

    /**
     * Menghapus destinasi dengan proteksi array pada gallery
     */
    public function destroy(Destination $destination)
    {
        // Hapus Cover fisik
        if ($destination->cover_image && Storage::disk('public')->exists($destination->cover_image)) {
            Storage::disk('public')->delete($destination->cover_image);
        }

        // PROTEKSI DELETE: Paksa gallery menjadi array sebelum di-foreach agar tidak ErrorException
        $galleries = is_array($destination->gallery) 
            ? $destination->gallery 
            : (json_decode($destination->gallery, true) ?? []);

        if (!empty($galleries)) {
            foreach ($galleries as $file) {
                if (Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
            }
        }

        $destination->delete();

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil dihapus!');
    }
}