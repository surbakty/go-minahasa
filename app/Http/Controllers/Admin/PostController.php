<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Tambahkan ini agar Intelephense senang

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'cover_image' => 'required|image|max:2048',
            'body' => 'required',
            'category' => 'nullable|string'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        
        // Menggunakan Auth::user() lebih disukai oleh VS Code Intelephense
        $data['author'] = Auth::user()->name ?? 'Admin Go-Minahasa';
        
        // Membuat ringkasan artikel otomatis dari isi body
        $data['excerpt'] = Str::limit(strip_tags($request->body), 150);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('posts', 'public');
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil diterbitkan!');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'cover_image' => 'nullable|image|max:2048',
            'body' => 'required',
            'category' => 'nullable|string'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['excerpt'] = Str::limit(strip_tags($request->body), 150);

        if ($request->hasFile('cover_image')) {
            // Hapus foto lama jika ada (Ini alasan kita butuh import Storage)
            if ($post->cover_image) {
                Storage::disk('public')->delete($post->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Post $post)
    {
        if ($post->cover_image) {
            Storage::disk('public')->delete($post->cover_image);
        }
        
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil dihapus!');
    }
}