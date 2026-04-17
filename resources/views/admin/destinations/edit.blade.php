@extends('layouts.admin')

@section('content')
    <div class="p-6 md:p-10 bg-gray-50 min-h-screen">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Destinasi</h1>
                <p class="text-gray-500 text-sm">Update informasi untuk **{{ $destination->name }}**</p>
            </div>
            <a href="{{ route('admin.destinations.index') }}"
                class="text-gray-600 hover:text-gray-800 flex items-center gap-2 transition font-medium">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- Menampilkan Pesan Error Validasi --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-2xl shadow-sm">
                <div class="flex items-center mb-2">
                    <i class="fa-solid fa-circle-exclamation mr-2"></i>
                    <span class="font-bold">Opps! Ada kendala:</span>
                </div>
                <ul class="list-disc list-inside text-sm opacity-90">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.destinations.update', $destination->id) }}" method="POST"
            enctype="multipart/form-data" class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            @csrf
            @method('PUT')

            <div class="p-8 md:p-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                    {{-- KOLOM KIRI --}}
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Destinasi</label>
                            <input type="text" name="name" value="{{ old('name', $destination->name) }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-orange-500 transition-all"
                                required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                                {{-- PERBAIKAN: name="category_id" dan looping dari data $categories --}}
                                <select name="category_id"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-orange-500 bg-white" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ old('category_id', $destination->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
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
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Sampul (Opsional)</label>
                            <div class="border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center hover:border-orange-400 transition-all bg-gray-50/50">
                                <input type="file" name="cover_image"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                            </div>
                            @if($destination->cover_image)
                                <div class="mt-3 flex items-center gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                                    <img src="{{ asset('storage/' . $destination->cover_image) }}"
                                        class="h-12 w-12 object-cover rounded-lg shadow-sm" alt="Current Cover">
                                    <span class="text-xs text-gray-500 font-medium italic">Gambar saat ini aktif</span>
                                </div>
                            @endif
                        </div>

                        {{-- Update Galeri --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tambah Galeri (Multi-Upload)</label>
                            <div class="border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center hover:border-orange-400 transition-all bg-gray-50/50">
                                <input type="file" name="gallery[]" multiple
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                            </div>
                            <p class="text-[10px] text-orange-500 mt-2 font-bold uppercase tracking-wider italic">* Mengunggah foto baru akan mengganti galeri lama.</p>
                        </div>
                    </div>

                    {{-- KOLOM KANAN --}}
                    <div class="flex flex-col space-y-6">
                        <div class="flex flex-col flex-grow">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Lengkap</label>
                            <textarea name="description" rows="10"
                                class="w-full flex-grow px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-orange-500 resize-none transition-all">{{ old('description', $destination->description) }}</textarea>
                        </div>

                        {{-- Fasilitas --}}
                        @php
                            $currentFacilities = $destination->facilities ?? [];
                        @endphp

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3 text-center">Fasilitas Tersedia</label>
                            <div class="grid grid-cols-2 gap-y-3 gap-x-4 bg-gray-50 p-6 rounded-[2rem] border border-gray-100">
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
                                            {{ in_array($value, (array)($currentFacilities ?? [])) ? 'checked' : '' }}
                                            class="w-5 h-5 rounded-lg border-gray-300 text-orange-600 focus:ring-orange-500 transition-all">
                                        <span class="text-sm text-gray-600 group-hover:text-orange-600 transition-colors">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50/80 px-8 py-6 flex justify-end gap-4 border-t border-gray-100">
                <button type="submit"
                    class="px-10 py-3 bg-orange-600 text-white font-bold rounded-2xl shadow-lg shadow-orange-500/20 hover:bg-orange-700 active:scale-95 transition-all">
                    Update Destinasi
                </button>
            </div>
        </form>
    </div>
@endsection