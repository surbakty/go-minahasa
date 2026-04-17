@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4 py-4">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Tulis Artikel Baru</h1>
                <p class="text-slate-500">Berikan informasi menarik seputar wisata Minahasa.</p>
            </div>
            <a href="{{ route('admin.posts.index') }}"
                class="px-4 py-2 bg-slate-100 text-slate-600 rounded-lg hover:bg-slate-200 transition-all text-sm font-semibold">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- Kolom Kiri: Konten Utama --}}
                    <div class="lg:col-span-2 space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Judul Artikel</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                placeholder="Contoh: 5 Surga Tersembunyi di Minahasa"
                                class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
                            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Isi Artikel</label>
                            <textarea name="body" id="editor">{{ old('body') }}</textarea>
                            @error('body') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Kolom Kanan: Meta Data & Gambar --}}
                    <div class="space-y-6">
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Gambar Sampul</label>
                            <input type="file" name="cover_image"
                                class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 mb-4">
                            <p class="text-[10px] text-slate-400">Rekomendasi ukuran: 1200x630px (Max 2MB)</p>
                            @error('cover_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Kategori Artikel</label>
                            <select name="category"
                                class="w-full px-4 py-2.5 rounded-lg border border-slate-300 outline-none focus:ring-2 focus:ring-orange-500">
                                <option value="Tips Wisata">Tips Wisata</option>
                                <option value="Berita">Berita & Event</option>
                                <option value="Kuliner">Kuliner</option>
                                <option value="Budaya">Budaya</option>
                            </select>
                        </div>

                        <button type="submit"
                            class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded-lg shadow-lg shadow-orange-500/30 transition-all flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-2"></i> Terbitkan Artikel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Script CKEditor 5 --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo']
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <style>
        /* Mengatur tinggi minimum editor agar enak dilihat */
        .ck-editor__editable {
            min-height: 400px;
        }
    </style>
@endsection