@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4 py-4">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Daftar Artikel</h1>
                <p class="text-slate-500">Kelola berita dan tips wisata untuk Go-Minahasa.</p>
            </div>
            <a href="{{ route('admin.posts.create') }}"
                class="px-5 py-2.5 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-all text-sm font-bold shadow-lg shadow-orange-500/20">
                <i class="fas fa-plus mr-2"></i> Tulis Artikel
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Artikel</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Kategori</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Penulis</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Tanggal</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($posts as $post)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ asset('storage/' . $post->cover_image) }}"
                                            class="w-16 h-12 object-cover rounded-lg shadow-sm">
                                        <div>
                                            <span class="block font-bold text-slate-800 text-sm">{{ $post->title }}</span>
                                            <span
                                                class="text-xs text-slate-400">{{ Str::limit(strip_tags($post->body), 40) }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 bg-orange-50 text-orange-600 text-[10px] font-bold rounded-full uppercase">
                                        {{ $post->category ?? 'Umum' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $post->author }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500">
                                    {{ $post->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.posts.edit', $post->id) }}"
                                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all shadow-sm"
                                            title="Edit">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus artikel ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all shadow-sm"
                                                title="Hapus">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-slate-400 italic text-sm">
                                    Belum ada artikel yang diterbitkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection