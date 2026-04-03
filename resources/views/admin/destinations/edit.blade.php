@extends('layouts.admin')

@section('content')
    <div class="p-6 md:p-10 bg-gray-50 min-h-screen">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Destinasi</h1>
                <p class="text-gray-500 text-sm">Update informasi untuk {{ $destination->name }}</p>
            </div>
            <a href="{{ route('admin.destinations.index') }}"
                class="text-gray-600 hover:text-gray-800 flex items-center gap-2 transition">
                Kembali
            </a>
        </div>

        <form action="{{ route('admin.destinations.update', $destination->id) }}" method="POST"
            enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            @csrf
            @method('PUT')

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Destinasi</label>
                            <input type="text" name="name" value="{{ $destination->name }}"
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
                                <input type="number" name="price" value="{{ (int) $destination->price }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-orange-500"
                                    required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi</label>
                            <input type="text" name="location" value="{{ $destination->location }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-orange-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Baru (Kosongkan jika tidak
                                ingin ganti)</label>
                            <input type="file" name="cover_image" class="w-full text-sm text-gray-500">
                            <p class="mt-2 text-xs text-gray-400 font-medium italic">Gambar saat ini:
                                {{ $destination->cover_image }}</p>
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Lengkap</label>
                        <textarea name="description" rows="12"
                            class="w-full flex-grow px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-orange-500 resize-none">{{ $destination->description }}</textarea>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 px-8 py-5 flex justify-end gap-4 border-t border-gray-100">
                <button type="submit"
                    class="px-8 py-2.5 bg-orange-600 text-white font-bold rounded-xl shadow-lg hover:bg-orange-700 transition-all">
                    Update Destinasi
                </button>
            </div>
        </form>
    </div>
@endsection