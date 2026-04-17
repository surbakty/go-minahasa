@extends('layouts.admin')

@section('header', 'Kelola Kategori Wisata')

@section('content')
    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        {{-- Header Tabel --}}
        <div class="p-8 border-b border-slate-50 flex justify-between items-center">
            <div>
                <h3 class="text-xl font-bold text-slate-800">Daftar Kategori</h3>
                <p class="text-sm text-slate-500 mt-1">Kelola kategori untuk pengelompokan destinasi wisata.</p>
            </div>
            <a href="{{ route('admin.categories.create') }}"
                class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl font-bold text-sm transition-all shadow-lg shadow-orange-200 flex items-center">
                <i class="fa-solid fa-plus mr-2"></i> Tambah Kategori
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">No</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Nama Kategori</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Slug (URL)</th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Total Destinasi
                        </th>
                        <th class="px-8 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($categories as $category)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-8 py-5 text-sm font-bold text-slate-600">{{ $loop->iteration }}</td>
                            <td class="px-8 py-5">
                                <span class="font-bold text-slate-800 group-hover:text-orange-600 transition-colors">
                                    {{ $category->name }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-sm text-slate-500 font-mono">{{ $category->slug }}</td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-xs font-bold">
                                    {{ $category->destinations->count() }} Destinasi
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex justify-end gap-2">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>

                                    {{-- Form Hapus dengan SweetAlert --}}
                                    <form id="delete-form-{{ $category->id }}"
                                        action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="confirmDelete('{{ $category->id }}', '{{ $category->name }}')"
                                            class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-10 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fa-solid fa-tags text-4xl text-slate-200 mb-3"></i>
                                    <p class="text-slate-400 font-medium">Belum ada kategori wisata.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Script Konfirmasi Hapus --}}
    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus Kategori?',
                text: "Kategori '" + name + "' akan dihapus permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f97316', // Orange-500
                cancelButtonColor: '#64748b',  // Slate-500
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-[2rem]',
                    confirmButton: 'rounded-xl px-6 py-3 font-bold',
                    cancelButton: 'rounded-xl px-6 py-3 font-bold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection