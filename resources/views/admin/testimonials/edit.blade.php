@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4 py-4">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Edit Testimonial</h1>
                <p class="text-slate-500 text-sm">Perbarui ulasan dari pengunjung {{ $testimonial->name }}.</p>
            </div>
            <a href="{{ route('admin.testimonials.index') }}"
                class="px-4 py-2 bg-slate-100 text-slate-600 rounded-lg hover:bg-slate-200 transition-all text-sm font-semibold">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class="max-w-3xl bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST"
                enctype="multipart/form-data" class="p-8">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    {{-- Nama & Jabatan --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ $testimonial->name }}"
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 outline-none transition-all"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Pekerjaan / Label</label>
                            <input type="text" name="profession" value="{{ $testimonial->profession }}"
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 outline-none transition-all">
                        </div>
                    </div>

                    {{-- Foto Profil (Dengan Preview Foto Lama) --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">Foto Profil</label>
                        <div class="flex items-center gap-5 p-4 border-2 border-slate-200 rounded-2xl bg-slate-50/50">
                            <div class="relative w-20 h-20 flex-shrink-0">
                                <img id="image-preview"
                                    src="{{ $testimonial->photo ? asset('storage/' . $testimonial->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($testimonial->name) }}"
                                    class="w-full h-full rounded-full object-cover border-2 border-orange-500 p-0.5 shadow-md">
                            </div>

                            <div class="flex-1">
                                <div class="relative group">
                                    <input type="file" name="photo" id="photo-input"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20"
                                        accept="image/*" onchange="previewImage(this)">

                                    <div
                                        class="px-4 py-3 bg-white border-2 border-slate-300 border-dashed rounded-xl group-hover:border-orange-400 group-hover:bg-orange-50 transition-all text-center">
                                        <span class="text-xs font-bold text-slate-500 group-hover:text-orange-600">
                                            <i class="fas fa-sync-alt mr-1"></i> Ganti Foto Pengunjung
                                        </span>
                                    </div>
                                </div>
                                <p class="text-[10px] text-slate-400 mt-2 ml-1 italic">Kosongkan jika tidak ingin mengubah
                                    foto.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Rating Bintang --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Rating</label>
                        <select name="rating"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-300 outline-none focus:ring-2 focus:ring-orange-500 bg-white">
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ $testimonial->rating == $i ? 'selected' : '' }}>
                                    {{ str_repeat('⭐', $i) }} ({{ $i }} Bintang)
                                </option>
                            @endfor
                        </select>
                    </div>

                    {{-- Isi Testimoni --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Isi Testimoni</label>
                        <textarea name="content" rows="4"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 outline-none transition-all"
                            required>{{ $testimonial->content }}</textarea>
                    </div>

                    {{-- Tombol Update --}}
                    <div class="pt-4 flex justify-end border-t border-slate-100">
                        <button type="submit"
                            class="px-10 py-3 bg-slate-900 hover:bg-orange-600 text-white font-bold rounded-xl shadow-lg transition-all duration-300 flex items-center">
                            <i class="fas fa-save mr-2"></i> Perbarui Testimonial
                        </button>
                    </div>
                </div>

                <script>
                    function previewImage(input) {
                        const preview = document.getElementById('image-preview');
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                preview.src = e.target.result;
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>
            </form>
        </div>
    </div>
@endsection