@extends('layouts.admin')

@section('header', 'Tambah Kategori Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-50">
            <h3 class="text-xl font-bold text-slate-800">Form Kategori</h3>
            <p class="text-sm text-slate-500 mt-1">Masukkan nama kategori wisata yang ingin ditambahkan.</p>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST" class="p-8 space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Kategori</label>
                <input type="text" name="name" 
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all outline-none text-slate-600"
                    placeholder="Contoh: Wisata Kuliner" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl font-bold transition-all shadow-lg shadow-orange-200">
                    Simpan Kategori
                </button>
                <a href="{{ route('admin.categories.index') }}" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-600 px-6 py-3 rounded-xl font-bold text-center transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection