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
     * Menampilkan daftar destinasi terbaru
     */
    public function index()
    {
        // Mengambil semua data dari database diurutkan dari yang terbaru
        $destinations = Destination::latest()->get();
        
        // Mengirim ke view
        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.destinations.create');
    }

    /**
     * Menyimpan destinasi baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required',
            'location' => 'required|string|max:255', // Tambahkan validasi lokasi
            'price' => 'required|numeric',
            'description' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('destinations', 'public');
        }

        Destination::create($data);
        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil ditambah!');
    }

    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        return view('admin.destinations.edit', compact('destination'));
    }

    /**
     * Mengupdate data destinasi
     */
    public function update(Request $request, $id)
    {
        $destination = Destination::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required',
            'location' => 'required|string|max:255', // Tambahkan validasi lokasi
            'price' => 'required|numeric',
            'description' => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('cover_image')) {
            // Hapus gambar lama jika ada di storage
            if($destination->cover_image) {
                Storage::disk('public')->delete($destination->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('destinations', 'public');
        }

        $destination->update($data);
        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil diupdate!');
    }

    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);
        
        // Hapus gambar dari folder storage sebelum menghapus record di DB
        if($destination->cover_image) {
            Storage::disk('public')->delete($destination->cover_image);
        }
        
        $destination->delete();
        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil dihapus!');
    }
}