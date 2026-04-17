@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4 py-4">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Daftar Testimonial</h1>
                <p class="text-slate-500">Kelola ulasan pengunjung yang tampil di beranda.</p>
            </div>
            <a href="{{ route('admin.testimonials.create') }}"
                class="px-5 py-2.5 bg-orange-500 hover:bg-orange-600 text-white rounded-xl shadow-lg shadow-orange-500/30 transition-all text-sm font-bold flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Testimoni
            </a>
        </div>

        {{-- Alert Sukses --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Pengunjung</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-center">Rating</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Isi Testimoni</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($testimonials as $t)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $t->photo ? asset('storage/' . $t->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($t->name) }}"
                                        class="w-10 h-10 rounded-full object-cover">
                                    <div>
                                        <p class="font-bold text-slate-800">{{ $t->name }}</p>
                                        <p class="text-xs text-slate-500">{{ $t->profession }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-orange-400 font-bold">{{ str_repeat('⭐', $t->rating) }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600 max-w-xs truncate">
                                {{ $t->content }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end items-center gap-2">
                                    {{-- TOMBOL EDIT (INI YANG TADI HILANG) --}}
                                    <a href="{{ route('admin.testimonials.edit', $t->id) }}"
                                        class="w-8 h-8 flex items-center justify-center bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>

                                    {{-- TOMBOL HAPUS --}}
                                    <form action="{{ route('admin.testimonials.destroy', $t->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus testimoni ini?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="w-8 h-8 flex items-center justify-center bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-slate-400 italic">Belum ada data testimonial.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection