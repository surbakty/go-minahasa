@extends('layouts.admin')

@section('content')
    <div class="p-6 md:p-10 bg-gray-50 min-h-screen">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Destinasi</h1>
                <p class="text-gray-500 text-sm">Update informasi untuk **{{ $destination->name }}**</p>
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

        {{-- Form sudah ditambahkan enctype agar bisa kirim file --}}
        <form action="{{ route('admin.destinations.update', $destination->id) }}" method="POST"
            enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            @csrf
            @method('PUT')

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    {{-- KOLOM KIRI --}}
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Destinasi</label>
                            <input type="text" name="name" value="{{ old('name', $destination->name) }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-orange-500"
                                required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                                <select name="category"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-orange-500">
                                    <option value="Wisata Alam" {{ $destination->category == 'Wisata Alam' ? 'selected' : '' }}>Wisata Alam</option>
                                    <option value="Wisata Budaya" {{ $destination->category == 'Wisata Budaya' ? 'selected' : '' }}>Wisata Budaya</option>
                                    <option value="Wisata Buatan" {{ $destination->category == 'Wisata Buatan' ? 'selected' : '' }}>Wisata Buatan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rp)</label>
                                <input type="number" name="price" value="{{ old('price', $destination->price) }}" min="0"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 outline-none transition"
                                    placeholder="Isi 0 jika Gratis">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi</label>
                            <input type="text" name="location" value="{{ old('location', $destination->location) }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-orange-500"
                                required>
                        </div>

                        {{-- Update Foto Sampul --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Sampul (Biarkan kosong jika
                                tidak ganti)</label>
                            <div
                                class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-orange-400 transition">
                                <input type="file" name="cover_image"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                            </div>
                            @if($destination->cover_image)
                                <div class="mt-2 flex items-center gap-2">
                                    <span class="text-xs text-gray-400 italic">File saat ini:</span>
                                    <img src="{{ Storage::url($destination->cover_image) }}"
                                        class="h-10 w-10 object-cover rounded-md border" alt="Current Cover">
                                </div>
                            @endif
                        </div>

                        {{-- Update Galeri (Multi-Upload) --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tambah Cuplikan Keindahan
                                (Gallery)</label>
                            <div
                                class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-orange-400 transition">
                                <input type="file" name="gallery[]" multiple
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                            </div>
                            <p class="text-xs text-gray-500 mt-2 font-medium">*Mengunggah foto baru akan menambah koleksi
                                foto yang sudah ada.</p>
                        </div>
                    </div>

                    {{-- KOLOM KANAN --}}
                    <div class="flex flex-col space-y-6">
                        <div class="flex flex-col flex-grow">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Lengkap</label>
                            <textarea name="description" rows="8"
                                class="w-full flex-grow px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-orange-500 resize-none">{{ old('description', $destination->description) }}</textarea>
                        </div>

                        {{-- Fasilitas --}}
                        @php
                            // Mengubah data facilities menjadi array agar bisa dicek oleh in_array
                            $currentFacilities = is_array($destination->facilities) ? $destination->facilities : json_decode($destination->facilities, true) ?? [];
                        @endphp

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Fasilitas Tersedia</label>
                            <div class="grid grid-cols-2 gap-y-3 gap-x-4 bg-gray-50 p-5 rounded-2xl border border-gray-100">
                                @foreach([
                                        'wifi' => 'Free WiFi',
                                        'pemandu' => 'Pemandu Wisata',
                                        'akses24' => 'Akses 24 Jam',
                                        'parkir' => 'Area Parkir',
                                        'restoran' => 'Restoran',
                                        'toilet' => 'Toilet Umum',
                                        'ibadah' => 'Tempat Ibadah',
                                        'penginapan' => 'Penginapan',
                                        'spot_foto' => 'Spot Foto'
                                    ] as $value => $label)
                                        <label class="flex items-center gap-3 cursor-pointer group">
                                            <input type="checkbox" name="facilities[]" value="{{ $value }}" 
                                                    {{ in_array($value, $currentFacilities) ? 'checked' : '' }}
                                                class="w-5 h-5 rounded border-gray-300 text-orange-600 focus:ring-orange-500">
                                            <span class="text-sm text-gray-600 group-hover:text-slate-900 transition-colors">{{ $label }}</span>
                                        </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="bg-gray-50 px-8 py-5 flex justify-end gap-4 border-t border-gray-100">
                    <button type="submit"
                        class="px-8 py-2.5 bg-orange-600 text-white font-bold rounded-xl shadow-lg shadow-orange-200 hover:bg-orange-700 active:scale-95 transition-all">
                        Update Destinasi
                    </button>
                </div>
            </form>
        </div>
@endsection