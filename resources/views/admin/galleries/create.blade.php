@extends('layouts.admin')

@section('header', 'Tambah Koleksi Foto')

@section('content')
    @if ($errors->any())
        <div class="bg-red-50 text-red-500 p-4 rounded-2xl mb-6">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="max-w-3xl">
        <a href="{{ route('admin.galleries.index') }}"
            class="flex items-center text-slate-500 hover:text-orange-500 mb-6 transition-colors group">
            <i class="fa-solid fa-arrow-left-long mr-2 transition-transform group-hover:-translate-x-2"></i>
            <span class="font-bold text-sm uppercase tracking-widest">Kembali ke Galeri</span>
        </a>

        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100">
            <div class="mb-8">
                <h3 class="text-2xl font-black text-slate-800">Upload Foto Baru</h3>
                <p class="text-sm text-slate-500">Gunakan foto kualitas tinggi untuk hasil terbaik di landing page.</p>
            </div>

            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-3">Judul Foto / Keterangan Singkat</label>
                    <input type="text" name="title"
                        class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-orange-500 transition-all font-medium text-slate-800"
                        placeholder="Contoh: Keindahan Matahari Terbit di Bukit Kasih" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-3">Pilih File Foto</label>
                    <div class="relative group">
                        <input type="file" name="image"
                            class="w-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl px-6 py-10 text-center cursor-pointer hover:border-orange-300 transition-all file:hidden"
                            id="imageUpload" required>
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none"
                            id="preview-text">
                            <i
                                class="fa-solid fa-cloud-arrow-up text-3xl text-slate-300 mb-2 group-hover:text-orange-500 transition-colors"></i>
                            <p class="text-sm text-slate-400 group-hover:text-slate-600">Klik atau seret foto ke sini</p>
                            <p class="text-[10px] text-slate-400 mt-1 uppercase font-bold tracking-tighter italic">Max size:
                                5MB (JPG, PNG)</p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit"
                        class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 rounded-2xl shadow-lg shadow-orange-200 transition-all flex items-center justify-center gap-2">
                        <i class="fa-solid fa-save"></i>
                        Simpan ke Koleksi
                    </button>
                    <a href="{{ route('admin.galleries.index') }}"
                        class="px-8 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-4 rounded-2xl transition-all">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection