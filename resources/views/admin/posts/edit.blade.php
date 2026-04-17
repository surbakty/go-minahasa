@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4 py-4">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Edit Artikel</h1>
                <p class="text-slate-500">Kemaskini maklumat artikel anda.</p>
            </div>
            <a href="{{ route('admin.posts.index') }}"
                class="px-4 py-2 bg-slate-100 text-slate-600 rounded-lg hover:bg-slate-200 transition-all text-sm font-semibold">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data"
                class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- Kolom Kiri: Konten Utama --}}
                    <div class="lg:col-span-2 space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Judul Artikel</label>
                            <input type="text" name="title" value="{{ old('title', $post->title) }}"
                                class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-orange-500 outline-none transition-all">
                            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Isi Artikel</label>
                            <textarea name="body" id="editor">{{ old('body', $post->body) }}</textarea>
                            @error('body') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Kolom Rician: Meta Data & Gambar --}}
                    <div class="space-y-6">
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Gambar Sampul Sekarang</label>
                            <img src="{{ asset('storage/' . $post->cover_image) }}"
                                class="w-full h-32 object-cover rounded-lg mb-4 shadow-sm">

                            <label class="block text-sm font-bold text-slate-700 mb-2">Tukar Gambar (Kosongkan jika tidak
                                tukar)</label>
                            <input type="file" name="cover_image"
                                class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                            @error('cover_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Kategori Artikel</label>
                            <select name="category"
                                class="w-full px-4 py-2.5 rounded-lg border border-slate-300 outline-none focus:ring-2 focus:ring-orange-500">
                                @foreach(['Tips Wisata', 'Berita', 'Kuliner', 'Budaya'] as $cat)
                                    <option value="{{ $cat }}" {{ $post->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-lg shadow-blue-500/30 transition-all flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#editor')).catch(error => { console.error(error); });
    </script>
    <style>
        .ck-editor__editable {
            min-height: 400px;
        }
    </style>
@endsection