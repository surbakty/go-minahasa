@extends('layouts.admin')

@section('header', 'Kelola Staff Editor')

@section('content')
    {{--
    LOGIKA PENTING:
    - openModal: true jika ada error dan BUKAN berasal dari proses edit (tidak ada id_edit)
    - openEditModal: true jika ada error dan berasal dari proses edit (ada id_edit)
    --}}
    <div x-data="{ 
                openModal: {{ ($errors->any() && !old('id_edit')) ? 'true' : 'false' }}, 
                openEditModal: {{ ($errors->any() && old('id_edit')) ? 'true' : 'false' }}, 
                editData: {
                    id: '{{ old('id_edit') }}', 
                    name: '{{ old('name') }}', 
                    email: '{{ old('email') }}'
                } 
            }" @fill-edit.window="editData = $event.detail; openEditModal = true" x-cloak>

        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-xl text-slate-900">Daftar Staff</h3>
                    <p class="text-slate-400 text-xs mt-1 uppercase tracking-widest">Manajemen Hak Akses Editor</p>
                </div>

                <button @click="openModal = true"
                    class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-2xl font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-orange-200">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Editor Baru
                </button>
            </div>

            <div class="p-8">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-separate border-spacing-y-3">
                        <thead>
                            <tr class="text-slate-400 text-[10px] uppercase tracking-[0.2em] font-black">
                                <th class="px-6 py-3">Nama Staff</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Role</th>
                                <th class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr class="group">
                                    <td class="px-6 py-4 bg-slate-50 group-hover:bg-slate-100 rounded-l-2xl transition-all">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-10 h-10 rounded-xl bg-slate-200 flex items-center justify-center font-bold text-slate-500 text-xs">
                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                            </div>
                                            <span class="font-bold text-slate-700">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td
                                        class="px-6 py-4 bg-slate-50 group-hover:bg-slate-100 transition-all font-medium text-slate-500">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 bg-slate-50 group-hover:bg-slate-100 transition-all">
                                        <span
                                            class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-tighter bg-blue-100 text-blue-600">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td
                                        class="px-6 py-4 bg-slate-50 group-hover:bg-slate-100 rounded-r-2xl transition-all text-center">
                                        <div class="flex justify-center gap-2">
                                            <button type="button"
                                                @click="$dispatch('fill-edit', { id: '{{ $user->id }}', name: '{{ $user->name }}', email: '{{ $user->email }}' })"
                                                class="w-9 h-9 bg-white text-blue-600 rounded-xl shadow-sm hover:bg-blue-600 hover:text-white transition-all">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>

                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete(this)"
                                                    class="w-9 h-9 bg-white text-red-500 rounded-xl shadow-sm hover:bg-red-500 hover:text-white transition-all">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-10 text-slate-400 italic">Belum ada staff editor lain.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- MODAL TAMBAH --}}
        <div x-show="openModal"
            class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-cloak>
            <div @click.away="openModal = false"
                class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl overflow-hidden">
                <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                    <h3 class="font-black text-slate-800 uppercase tracking-tight">Tambah Staff Baru</h3>
                    <button @click="openModal = false" class="text-slate-400 hover:text-slate-600">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>
                <form action="{{ route('admin.users.store') }}" method="POST" class="p-8 space-y-5">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama
                            Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full px-5 py-4 rounded-2xl border-2 {{ ($errors->has('name') && !old('id_edit')) ? 'border-red-500' : 'border-slate-100' }} focus:border-orange-500 focus:ring-0 transition-all text-sm font-bold">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Email
                            Staff</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-5 py-4 rounded-2xl border-2 {{ ($errors->has('email') && !old('id_edit')) ? 'border-red-500' : 'border-slate-100' }} focus:border-orange-500 focus:ring-0 transition-all text-sm font-bold">
                    </div>
                    <div>
                        <label
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-5 py-4 rounded-2xl border-2 {{ ($errors->has('password') && !old('id_edit')) ? 'border-red-500' : 'border-slate-100' }} focus:border-orange-500 focus:ring-0 transition-all text-sm font-bold">
                        <p class="text-[9px] text-slate-400 mt-1">*Minimal 8 karakter</p>
                    </div>
                    <button type="submit"
                        class="w-full bg-slate-900 text-white py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-orange-600 transition-all">
                        Simpan Data Staff
                    </button>
                </form>
            </div>
        </div>

        {{-- MODAL EDIT --}}
        <div x-show="openEditModal"
            class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-cloak>
            <div @click.away="openEditModal = false"
                class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl overflow-hidden">
                <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-blue-50/50">
                    <h3 class="font-black text-slate-800 uppercase tracking-tight">Edit Data Staff</h3>
                    <button @click="openEditModal = false" class="text-slate-400 hover:text-slate-600">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>
                <form :action="'{{ url('admin/users') }}/' + editData.id" method="POST" class="p-8 space-y-5">
                    @csrf
                    @method('PUT')
                    {{-- Hidden input untuk menandai bahwa ini proses EDIT jika terjadi error --}}
                    <input type="hidden" name="id_edit" x-model="editData.id">

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama
                            Lengkap</label>
                        <input type="text" name="name" x-model="editData.name" required
                            class="w-full px-5 py-4 rounded-2xl border-2 border-slate-100 focus:border-blue-500 focus:ring-0 transition-all text-sm font-bold">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Email
                            Staff</label>
                        <input type="email" name="email" x-model="editData.email" required
                            class="w-full px-5 py-4 rounded-2xl border-2 border-slate-100 focus:border-blue-500 focus:ring-0 transition-all text-sm font-bold">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">
                            Password Baru (Kosongkan jika tidak ganti)
                        </label>
                        <input type="password" name="password"
                            class="w-full px-5 py-4 rounded-2xl border-2 {{ ($errors->has('password') && old('id_edit')) ? 'border-red-500' : 'border-slate-100' }} focus:border-blue-500 focus:ring-0 transition-all text-sm font-bold">

                        @if($errors->has('password') && old('id_edit'))
                            <p class="text-[10px] text-red-500 mt-1">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-blue-700 transition-all">
                        Update Data Staff
                    </button>
                </form>
            </div>
        </div>

    </div>

    {{-- SCRIPT SWEETALERT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2500,
                    customClass: { popup: 'rounded-[2rem]' }
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: `
                                <div class="text-left text-sm">
                                    <ul class="list-disc pl-5">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            `,
                    customClass: { popup: 'rounded-[2rem]' }
                });
            @endif
            });

        function confirmDelete(button) {
            Swal.fire({
                title: 'Hapus Staff?',
                text: "Akses editor ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f97316',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-[2rem]' }
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            })
        }
    </script>
@endsection