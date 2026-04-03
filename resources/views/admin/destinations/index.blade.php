@extends('layouts.admin')

@section('header', 'Kelola Destinasi')

@section('content')
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex justify-between items-center">
            <div>
                <h3 class="font-bold text-xl text-slate-900">Daftar Wisata</h3>
                <p class="text-sm text-slate-500">Total {{ $destinations->count() }} destinasi terdaftar</p>
            </div>
            <a href="{{ route('admin.destinations.create') }}"
                class="px-6 py-3 bg-orange-600 text-white rounded-2xl font-bold hover:bg-orange-700 transition-all shadow-lg shadow-orange-500/20">
                + Tambah Destinasi
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
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                            <td class="py-4 px-8">
                                <img src="{{ asset('storage/' . $destination->cover_image) }}" alt="{{ $destination->name }}"
                                    class="w-16 h-12 object-cover rounded-lg shadow-sm">
                            </td>
                            <td class="py-4 px-8">
                                <span class="font-semibold text-gray-800">{{ $destination->name }}</span>
                            </td>
                            <td class="py-4 px-8 text-sm text-gray-600">
                                {{ $destination->category }}
                            </td>
                            <td class="py-4 px-8 text-sm text-gray-600 italic">
                                {{ $destination->location ?? 'Lokasi belum diatur' }}
                            </td>
                            <td class="py-4 px-8 font-medium text-orange-600">
                                Rp {{ number_format($destination->price, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-8">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('admin.destinations.edit', $destination->id) }}"
                                        class="w-10 h-10 flex items-center justify-center bg-blue-50 text-blue-600 rounded-full hover:bg-blue-100 transition-all border border-blue-100 shadow-sm"
                                        title="Edit Destinasi">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>

                                    <button type="button" onclick="confirmDelete({{ $destination->id }})"
                                        class="w-10 h-10 flex items-center justify-center bg-red-50 text-red-600 rounded-full hover:bg-red-100 transition-all border border-red-100 shadow-sm"
                                        title="Hapus Destinasi">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
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
                            <td colspan="6" class="py-20 text-center text-slate-400">
                                <p class="italic text-lg">Belum ada data destinasi.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data destinasi ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ea580c',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            borderRadius: '20px'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>