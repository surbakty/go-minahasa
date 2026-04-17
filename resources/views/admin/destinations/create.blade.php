@extends('layouts.admin')

@section('content')
    <div class="p-6 md:p-10 bg-gray-50 min-h-screen">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Tambah Destinasi Baru</h1>
                <p class="text-gray-500 text-sm">Isi detail informasi untuk destinasi wisata baru.</p>
            </div>
            <a href="{{ route('admin.destinations.index') }}"
                class="text-gray-600 hover:text-gray-800 flex items-center gap-2 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
        </div>

        {{-- 1. Form sudah menggunakan enctype="multipart/form-data" --}}

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-500 text-white rounded-2xl shadow-lg shadow-red-200">
                <p class="font-bold mb-2 uppercase tracking-widest text-xs">Gagal Menyimpan:</p>
                <ul class="list-disc ml-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            @csrf
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    {{-- KOLOM KIRI --}}
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Destinasi</label>
                            <input type="text" name="name" placeholder="Contoh: Taman Laut Bunaken"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition"
                                required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-sm font-bold text-slate-700 mb-2">Kategori Wisata</label>
                                <select name="category_id" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 outline-none text-slate-600" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rp)</label>
                                <input type="number" name="price" value="0" min="0"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 outline-none transition"
                                    placeholder="Isi 0 jika Gratis">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi (Kota/Kabupaten)</label>
                            <input type="text" name="location" placeholder="Contoh: Manado, Sulawesi Utara"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 outline-none transition"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Sampul Utama</label>
                            <div
                                class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-orange-400 transition">
                                <input type="file" name="cover_image"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100"
                                    required>
                            </div>
                        </div>

                        {{-- 2. Input Multi-Upload untuk Galeri yang sudah disesuaikan --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Cuplikan Keindahan
                                (Gallery)</label>
                            <div
                                class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-orange-400 transition">
                                <input type="file" name="gallery[]" multiple
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                            </div>
                            <p class="text-xs text-gray-500 mt-2 font-medium">*Anda bisa memilih lebih dari satu foto
                                sekaligus (tahan Ctrl/Command)</p>
                        </div>
                    </div>

                    {{-- KOLOM KANAN --}}
                    <div class="flex flex-col space-y-6">
                        <div class="flex flex-col flex-grow">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Lengkap</label>
                            <textarea name="description" rows="8" placeholder="Jelaskan keindahan destinasi ini..."
                                class="w-full flex-grow px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 outline-none transition resize-none"></textarea>
                        </div>

                        {{-- Checkbox untuk Fasilitas --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Fasilitas Tersedia</label>
                            <div class="grid grid-cols-2 gap-y-3 gap-x-4 bg-gray-50 p-5 rounded-2xl border border-gray-100">
                                @php
                                    $availableFacilities = [
                                        'wifi' => 'Free WiFi',
                                        'pemandu' => 'Pemandu Wisata',
                                        'akses24' => 'Akses 24 Jam',
                                        'parkir' => 'Area Parkir',
                                        'restoran' => 'Restoran',
                                        'toilet' => 'Toilet Umum',
                                        'ibadah' => 'Tempat Ibadah',
                                        'penginapan' => 'Penginapan',
                                        'spot_foto' => 'Spot Foto'
                                    ];
                                @endphp

                                @foreach($availableFacilities as $value => $label)
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" name="facilities[]" value="{{ $value }}"
                                            class="w-5 h-5 rounded border-gray-300 text-orange-600 focus:ring-orange-500">
                                        <span
                                            class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 px-8 py-5 flex justify-end gap-4 border-t border-gray-100">
                <button type="reset"
                    class="px-6 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 transition">Reset</button>
                <button type="submit"
                    class="px-8 py-2.5 bg-orange-600 text-white font-bold rounded-xl shadow-lg shadow-orange-200 hover:bg-orange-700 active:scale-95 transition-all">
                    Simpan Destinasi
                </button>
            </div>
        </form>
    </div>
@endsection