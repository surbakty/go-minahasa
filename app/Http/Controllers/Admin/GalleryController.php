<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required', // Kita buat longgar sesuai permintaanmu sebelumnya
        ]);

        // Opsi A: Ambil hanya data yang kita butuhkan saja (Sangat Disarankan)
        $data = $request->only(['title', 'is_active']);

        // Opsi B: Jika tetap ingin pakai all(), hapus tokennya dulu
        // $data = $request->except('_token');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('galleries', 'public');
        }

        $data['is_active'] = true;

        // Sekarang sistem tidak akan mencoba memasukkan [_token] ke database
        Gallery::create($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Foto berhasil ditambahkan!');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }
        $gallery->delete();
        return back()->with('success', 'Foto berhasil dihapus!');
    }
}