@extends('layouts.visitor')

@section('title', 'Jelajahi Destinasi - Go Minahasa')

@push('styles')
    <style>
        .text-gradient {
            background: linear-gradient(to right, #f97316, #ea580c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* OPTIMASI: Memberitahu browser untuk menggunakan akselerasi GPU */
        .desti-card-optimized {
            will-change: transform;
            backface-visibility: hidden;
            transform: translateZ(0);
        }

        /* Menghilangkan scrollbar pada filter jika overflow */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endpush

@section('content')
    {{-- Hero Section --}}
    <section class="relative pt-40 pb-20 bg-slate-950 overflow-hidden w-full">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1596438459194-f275f413d6ff?auto=format&fit=crop&q=60"
                class="w-full h-full object-cover opacity-20" alt="Background">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-slate-950/40 to-slate-950"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 text-center">
            <div class="max-w-3xl mx-auto space-y-4">
                <div
                    class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-orange-500/10 border border-orange-500/20">
                    <span class="text-[10px] font-bold text-orange-500 uppercase tracking-widest">Katalog Eksplorasi</span>
                </div>
                <h1 class="text-5xl md:text-6xl font-black text-white leading-tight">
                    Katalog <span class="text-gradient">Destinasi</span>
                </h1>
                <p class="text-gray-400 text-lg leading-relaxed">
                    Jelajahi keajaiban Sulawesi Utara dari katalog yang telah dikurasi secara eksklusif untuk petualangan
                    tak terlupakan Anda.
                </p>
            </div>
        </div>
    </section>

    {{-- Section Filter & Search Bar --}}
    <section class="py-12 bg-white">
        <div class="container mx-auto px-6">
            <div
                class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 border-b border-slate-100 pb-10 mb-12">
                {{-- Filter Bar --}}
                <div class="flex items-center gap-3 overflow-x-auto no-scrollbar py-2">
                    <span class="text-slate-400 font-bold text-xs uppercase tracking-widest mr-2 text-nowrap">Filter:</span>
                    <button
                        class="px-6 py-2.5 rounded-full bg-orange-600 text-white text-xs font-bold shadow-lg shadow-orange-500/20">Semua</button>
                    <button
                        class="px-6 py-2.5 rounded-full border border-slate-200 text-slate-500 text-xs font-bold hover:border-orange-500 hover:text-orange-500 transition-all text-nowrap">Wisata
                        Alam</button>
                    <button
                        class="px-6 py-2.5 rounded-full border border-slate-200 text-slate-500 text-xs font-bold hover:border-orange-500 hover:text-orange-500 transition-all text-nowrap">Wisata
                        Budaya</button>
                    <button
                        class="px-6 py-2.5 rounded-full border border-slate-200 text-slate-500 text-xs font-bold hover:border-orange-500 hover:text-orange-500 transition-all text-nowrap">Wisata
                        Buatan</button>
                </div>

                {{-- Search Bar --}}
                <div class="w-full lg:w-80 relative group">
                    <div
                        class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-orange-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" placeholder="Cari destinasi..."
                        class="w-full pl-11 pr-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-orange-500 focus:bg-white focus:outline-none transition-all shadow-sm">
                </div>
            </div>

            {{-- Grid Destinasi --}}
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @for ($i = 1; $i <= 10; $i++)
                    <div
                        class="desti-card-optimized group relative h-80 rounded-[2rem] overflow-hidden border border-slate-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <img src="https://images.unsplash.com/photo-1542332213-31f87348057f?auto=format&fit=crop&q=60&w=400&sig={{$i}}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            alt="Destinasi">

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-90 transition-opacity">
                        </div>

                        <div class="absolute bottom-6 left-6 right-6">
                            <h3 class="text-lg font-bold text-white mb-2 leading-tight">Nama Wisata {{$i}}</h3>

                            {{-- SESUAI REQUEST: Link diarahkan ke /destination/bunaken --}}
                            <a href="/destination/bunaken"
                                class="text-[10px] font-black text-orange-500 uppercase tracking-[0.2em] flex items-center gap-2 group/link">
                                LIHAT DETAIL
                                <svg class="w-3 h-3 transform group-hover/link:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endfor
            </div>

            {{-- Pagination Simple --}}
            <div class="mt-16 flex justify-center items-center gap-2">
                <button
                    class="w-10 h-10 flex items-center justify-center rounded-xl bg-orange-600 text-white font-bold shadow-lg shadow-orange-500/30">1</button>
                <button
                    class="w-10 h-10 flex items-center justify-center rounded-xl border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition">2</button>
                <button
                    class="w-10 h-10 flex items-center justify-center rounded-xl border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition">3</button>
            </div>
        </div>
    </section>
@endsection