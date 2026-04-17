@extends('layouts.visitor')

@section('title', 'Jelajahi Destinasi - Go Minahasa')

@push('styles')
    <style>
        .text-gradient {
            background: linear-gradient(to right, #f97316, #ea580c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .desti-card-optimized {
            will-change: transform;
            backface-visibility: hidden;
            transform: translateZ(0);
        }

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

                {{-- Filter Bar Dinamis --}}
                <div class="flex items-center gap-3 overflow-x-auto no-scrollbar py-2">
                    <span class="text-slate-400 font-bold text-xs uppercase tracking-widest mr-2 text-nowrap">Filter:</span>

                    <a href="{{ route('destinations.index', ['search' => request('search')]) }}"
                        class="px-6 py-2.5 rounded-full text-xs font-bold transition-all {{ !request('category') || request('category') == 'Semua' ? 'bg-orange-600 text-white shadow-lg shadow-orange-500/20' : 'border border-slate-200 text-slate-500 hover:border-orange-500 hover:text-orange-500' }}">
                        Semua
                    </a>

                    @foreach(['Wisata Alam', 'Wisata Budaya', 'Wisata Buatan'] as $cat)
                        <a href="{{ route('destinations.index', ['category' => $cat, 'search' => request('search')]) }}"
                            class="px-6 py-2.5 rounded-full border text-xs font-bold transition-all text-nowrap {{ request('category') == $cat ? 'bg-orange-600 text-white border-orange-600 shadow-lg shadow-orange-500/20' : 'border-slate-200 text-slate-500 hover:border-orange-500 hover:text-orange-500' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>

                {{-- Search Bar Dinamis --}}
                <form action="{{ route('destinations.index') }}" method="GET" class="w-full lg:w-80 relative group">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif

                    <div
                        class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-orange-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari destinasi..."
                        class="w-full pl-11 pr-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-orange-500 focus:bg-white focus:outline-none transition-all shadow-sm">
                </form>
            </div>

            {{-- Grid Destinasi Dinamis --}}
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @forelse($destinations as $destination)
                    <div
                        class="desti-card-optimized group relative h-80 rounded-[2rem] overflow-hidden border border-slate-100 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">

                        {{-- Cover Image --}}
                        <img src="{{ asset('storage/' . $destination->cover_image) }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                            alt="{{ $destination->name }}">

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent opacity-90 transition-opacity">
                        </div>

                        <div class="absolute bottom-6 left-6 right-6">
                            {{-- Teks JSON dihapus agar tampilan bersih, kategori sudah terwakili oleh Filter di atas --}}

                            <h3 class="text-lg font-bold text-white mb-2 leading-tight">{{ $destination->name }}</h3>

                            {{-- Link Detail --}}
                            <a href="{{ route('destinations.show', $destination->slug) }}"
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
                @empty
                    <div class="col-span-full py-20 text-center">
                        <p class="text-slate-400 font-medium">Tidak ada destinasi yang ditemukan.</p>
                        <a href="{{ route('destinations.index') }}" class="text-orange-500 font-bold mt-2 inline-block">Reset
                            Pencarian</a>
                    </div>
                @endforelse
            </div>

            {{-- Info Jumlah Data --}}
            <div class="mt-16 flex justify-center text-slate-400 text-xs font-bold uppercase tracking-widest">
                Menampilkan {{ $destinations->count() }} Destinasi
            </div>
        </div>
    </section>
@endsection