@extends('layouts.visitor')

@section('title', 'Detail Wisata - Go Minahasa')

@push('styles')
    <style>
        .text-gradient {
            background: linear-gradient(to right, #f97316, #ea580c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .sticky-booking {
            top: 100px;
        }
    </style>
@endpush

@section('content')
    {{-- Hero Detail: Gambar Penuh dengan Overlay --}}
    <section class="relative h-[70vh] w-full overflow-hidden">
        <img src="https://images.unsplash.com/photo-1542332213-31f87348057f?auto=format&fit=crop&q=80"
            class="w-full h-full object-cover" alt="Nama Wisata">
        <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-black/40"></div>

        <div class="absolute bottom-12 left-0 w-full">
            <div class="container mx-auto px-6">
                <div class="max-w-3xl space-y-4">
                    <nav class="flex text-sm text-white/80 space-x-2 mb-4">
                        <a href="/" class="hover:text-orange-500 transition">Beranda</a>
                        <span>/</span>
                        <a href="/destinasi" class="hover:text-orange-500 transition">Destinasi</a>
                        <span>/</span>
                        <span class="text-white font-bold">Detail Wisata</span>
                    </nav>
                    <h1 class="text-4xl md:text-6xl font-black text-slate-900 leading-tight">
                        Taman Laut <span class="text-gradient">Bunaken</span>
                    </h1>
                    <div class="flex flex-wrap items-center gap-6 text-slate-700">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="font-medium text-sm">Manado, Sulawesi Utara</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <span class="font-medium text-sm">4.9 (120 Ulasan)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Content Section --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                {{-- Kiri: Deskripsi & Galeri --}}
                <div class="lg:col-span-2 space-y-12">
                    <div class="space-y-6">
                        <h2 class="text-3xl font-bold text-slate-900 border-l-4 border-orange-500 pl-4">Tentang Destinasi
                        </h2>
                        <p class="text-slate-600 leading-relaxed text-lg">
                            Taman Laut Bunaken adalah salah satu taman laut terindah di dunia. Dengan keanekaragaman hayati
                            yang luar biasa, tempat ini merupakan surga bagi para penyelam dan pecinta alam bawah laut.
                            Terletak di perairan Teluk Manado, Bunaken menawarkan pemandangan terumbu karang yang
                            spektakuler dan ribuan spesies ikan tropis yang berwarna-warni.
                        </p>
                        <p class="text-slate-600 leading-relaxed">
                            Selain diving, pengunjung juga dapat menikmati keindahan pantai, snorkeling, atau berkeliling
                            menggunakan perahu katamaran. Keindahan matahari terbenam di sini juga merupakan salah satu
                            momen yang paling dinantikan oleh para wisatawan.
                        </p>
                    </div>

                    {{-- Fasilitas --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 py-8 border-y border-slate-100">
                        <div class="flex flex-col items-center text-center space-y-2">
                            <div
                                class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-900 uppercase tracking-tighter">Penginapan</span>
                        </div>
                        <div class="flex flex-col items-center text-center space-y-2">
                            <div
                                class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-900 uppercase tracking-tighter">Akses 24 Jam</span>
                        </div>
                        <div class="flex flex-col items-center text-center space-y-2">
                            <div
                                class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-900 uppercase tracking-tighter">Pemandu Wisata</span>
                        </div>
                        <div class="flex flex-col items-center text-center space-y-2">
                            <div
                                class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071a10.5 10.5 0 0114.142 0M12 4v4m-4 8l4-4 4 4">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-900 uppercase tracking-tighter">Free WiFi</span>
                        </div>
                    </div>

                    {{-- Galeri Mini --}}
                    <div class="space-y-6">
                        <h3 class="text-2xl font-bold text-slate-900">Cuplikan Keindahan</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <img src="https://images.unsplash.com/photo-1582967788606-a171c1080cb0?auto=format&fit=crop&q=80"
                                class="rounded-[2rem] w-full h-64 object-cover" alt="Galeri 1">
                            <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&q=80"
                                class="rounded-[2rem] w-full h-64 object-cover" alt="Galeri 2">
                        </div>
                    </div>
                </div>

                {{-- Kanan: Sticky Info Card --}}
                <div class="lg:relative">
                    <div class="sticky sticky-booking glass-card p-8 rounded-[3rem] shadow-2xl border border-slate-100">
                        <div class="space-y-6">
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500 font-medium">Harga Mulai</span>
                                <span class="text-2xl font-black text-orange-600">Rp 250.000<small
                                        class="text-xs text-slate-400 font-normal">/org</small></span>
                            </div>

                            <hr class="border-slate-200">

                            <div class="space-y-4">
                                <p class="text-sm font-bold text-slate-900 uppercase tracking-widest">Waktu Terbaik
                                    Berkunjung</p>
                                <div class="flex items-center gap-3 p-4 bg-orange-50 rounded-2xl">
                                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                    <span class="text-sm text-slate-700 font-medium">Mei - September (Musim Panas)</span>
                                </div>
                            </div>

                            <button
                                class="w-full bg-slate-900 text-white py-5 rounded-2xl font-bold shadow-xl shadow-slate-200 hover:bg-orange-600 transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-widest text-xs">
                                Konsultasi Perjalanan
                            </button>

                            <p class="text-center text-[10px] text-slate-400 font-medium px-4 leading-relaxed">
                                Butuh paket khusus rombongan atau keluarga? Hubungi kami untuk penawaran terbaik.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection