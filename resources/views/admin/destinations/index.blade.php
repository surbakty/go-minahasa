@extends('layouts.admin')

@section('header', 'Kelola Destinasi')

@section('content')
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        {{-- Header Tabel --}}
        <div class="p-8 border-b border-slate-50 flex justify-between items-center">
            <div>
                <h3 class="font-bold text-xl text-slate-900">Daftar Wisata</h3>
                <p class="text-sm text-slate-500 mt-1">Total {{ $destinations->count() }} destinasi terdaftar</p>
            </div>
            <a href="{{ route('admin.destinations.create') }}"
                class="px-6 py-3 bg-orange-600 text-white rounded-2xl font-bold hover:bg-orange-700 transition-all shadow-lg shadow-orange-500/20 flex items-center">
                <i class="fa-solid fa-plus mr-2"></i> Tambah Destinasi
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-gray-100">
                        <th class="py-4 px-8 text-sm font-bold text-slate-700 uppercase tracking-wider">Gambar</th>
                        <th class="py-4 px-8 text-sm font-bold text-slate-700 uppercase tracking-wider">Nama Destinasi</th>
                        <th class="py-4 px-8 text-sm font-bold text-slate-700 uppercase tracking-wider">Kategori</th>
                        <th class="py-4 px-8 text-sm font-bold text-slate-700 uppercase tracking-wider">Lokasi</th>
                        <th class="py-4 px-8 text-sm font-bold text-slate-700 uppercase tracking-wider">Harga</th>
                        <th class="py-4 px-8 text-sm font-bold text-slate-700 uppercase tracking-wider text-center">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($destinations as $destination)
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition group">
                            {{-- Kolom Gambar --}}
                            <td class="py-4 px-8">
                                @if($destination->cover_image)
                                    <img src="{{ asset('storage/' . $destination->cover_image) }}" alt="{{ $destination->name }}"
                                        class="w-16 h-12 object-cover rounded-lg shadow-sm group-hover:scale-105 transition-transform">
                                @else
                                    <div class="w-16 h-12 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400">
                                        <i class="fa-solid fa-image"></i>
                                    </div>
                                @endif
                            </td>

                            {{-- Nama Destinasi --}}
                            <td class="py-4 px-8">
                                <span class="font-bold text-slate-800 block">{{ $destination->name }}</span>
                                <span class="text-[10px] text-slate-400 font-mono">{{ $destination->slug }}</span>
                            </td>

                            {{-- Kolom Kategori (PERBAIKAN DISINI) --}}
                            <td class="py-4 px-8">
                                <span
                                    class="px-3 py-1 bg-orange-50 text-orange-600 rounded-full text-xs font-bold border border-orange-100 inline-block">
                                    {{-- Cek apakah relasi category ada dan memiliki properti name --}}
                                    @if(isset($destination->category->name))
                                        {{ $destination->category->name }}
                                    @elseif(is_string($destination->category))
                                        {{-- Fallback jika data masih berupa string lama di database --}}
                                        {{ $destination->category }}
                                    @else
                                        <span class="text-slate-400 italic font-normal">Tanpa Kategori</span>
                                    @endif
                                </span>
                            </td>

                            {{-- Lokasi --}}
                            <td class="py-4 px-8 text-sm text-slate-500 font-medium">
                                <i class="fa-solid fa-location-dot mr-1 text-orange-500/50"></i>
                                {{ $destination->location ?? 'Lokasi belum diatur' }}
                            </td>

                            {{-- Harga --}}
                            <td class="py-4 px-8 font-medium">
                                @if($destination->price == 0)
                                    <span
                                        class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-bold uppercase tracking-wider border border-green-200">
                                        Gratis
                                    </span>
                                @else
                                    <span class="text-slate-900 font-bold">
                                        <span
                                            class="text-xs text-slate-400 mr-0.5">Rp</span>{{ number_format($destination->price, 0, ',', '.') }}
                                    </span>
                                @endif
                            </td>

                            {{-- Tombol Aksi --}}
                            <td class="py-4 px-8">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('admin.destinations.edit', $destination->id) }}"
                                        class="w-10 h-10 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all border border-blue-100 shadow-sm"
                                        title="Edit Destinasi">
                                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                                    </a>

                                    <button type="button"
                                        onclick="confirmDelete({{ $destination->id }}, '{{ $destination->name }}')"
                                        class="w-10 h-10 flex items-center justify-center bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all border border-red-100 shadow-sm"
                                        title="Hapus Destinasi">
                                        <i class="fa-solid fa-trash text-sm"></i>
                                    </button>

                                    <form id="delete-form-{{ $destination->id }}"
                                        action="{{ route('admin.destinations.destroy', $destination->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                        <i class="fa-solid fa-map-location-dot text-4xl text-slate-200"></i>
                                    </div>
                                    <p class="text-slate-400 font-medium italic">Belum ada data destinasi yang terdaftar.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Script Konfirmasi Hapus (SweetAlert2) --}}
    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus Destinasi?',
                text: "Destinasi '" + name + "' akan dihapus permanen dari sistem!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ea580c', // Orange-600
                cancelButtonColor: '#64748b',  // Slate-500
                confirmButtonText: 'Ya, Hapus Sekarang!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-[2.5rem] p-8',
                    confirmButton: 'rounded-2xl px-6 py-3 font-bold',
                    cancelButton: 'rounded-2xl px-6 py-3 font-bold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection