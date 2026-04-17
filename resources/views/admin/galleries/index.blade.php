@extends('layouts.admin')

@section('header', 'Galeri Wisata')

@section('content')
    <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h3 class="text-2xl font-black text-slate-800">Koleksi Visual</h3>
                <p class="text-sm text-slate-500 mt-1">Kelola foto-foto keindahan Minahasa untuk halaman utama.</p>
            </div>
            <a href="{{ route('admin.galleries.create') }}"
                class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-2xl font-bold transition-all shadow-lg shadow-orange-200 flex items-center gap-2 group">
                <i class="fa-solid fa-plus transition-transform group-hover:rotate-90"></i>
                Tambah Foto Baru
            </a>
        </div>

        @if($galleries->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($galleries as $gallery)
                    <div
                        class="group relative bg-slate-50 rounded-[1.5rem] overflow-hidden border border-slate-200 transition-all hover:shadow-xl hover:-translate-y-1">
                        <div class="aspect-video overflow-hidden">
                            <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>

                        <div class="p-5 flex justify-between items-center bg-white">
                            <div class="overflow-hidden">
                                <h4 class="font-bold text-slate-800 truncate">{{ $gallery->title }}</h4>
                                <p class="text-[10px] uppercase tracking-widest font-bold text-orange-500 mt-1">
                                    {{ $gallery->is_active ? 'Ditampilkan' : 'Draft' }}
                                </p>
                            </div>

                            <div class="flex gap-2">
                                <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all flex items-center justify-center">
                                        <i class="fa-solid fa-trash-can text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-image-navigation text-3xl text-slate-300"></i>
                </div>
                <h4 class="text-lg font-bold text-slate-800">Belum ada foto</h4>
                <p class="text-slate-500 text-sm">Mulailah dengan menambahkan foto keindahan alam Minahasa.</p>
            </div>
        @endif
    </div>
@endsection