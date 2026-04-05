@extends('layouts.visitor')

@section('title', $destination->name . ' - Go Minahasa')

@php
    // 1. MAPPING ICON & LABEL (Disamakan dengan checkbox di Admin)
    $iconMap = [
        'Free WiFi' => ['icon' => 'fa-wifi', 'label' => 'Free WiFi'],
        'Akses 24 Jam' => ['icon' => 'fa-clock', 'label' => 'Akses 24 Jam'],
        'Restoran' => ['icon' => 'fa-utensils', 'label' => 'Restoran'],
        'Tempat Ibadah' => ['icon' => 'fa-mosque', 'label' => 'Tempat Ibadah'],
        'Spot Foto' => ['icon' => 'fa-camera', 'label' => 'Spot Foto'],
        'Pemandu Wisata' => ['icon' => 'fa-user-tie', 'label' => 'Pemandu'],
        'Area Parkir' => ['icon' => 'fa-parking', 'label' => 'Area Parkir'],
        'Toilet Umum' => ['icon' => 'fa-restroom', 'label' => 'Toilet Umum'],
        'Penginapan' => ['icon' => 'fa-hotel', 'label' => 'Penginapan'],
    ];
@endphp

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
    {{-- Hero Detail Section --}}
    <section class="relative h-[65vh] w-full overflow-hidden">
        <img src="{{ asset('storage/' . $destination->cover_image) }}" class="w-full h-full object-cover"
            alt="{{ $destination->name }}">
        <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-black/40"></div>

        <div class="absolute bottom-10 left-0 w-full">
            <div class="container mx-auto px-6">
                <div class="max-w-3xl space-y-4">
                    {{-- Breadcrumbs --}}
                    <nav class="flex text-sm text-white/80 space-x-2 mb-4">
                        <a href="/" class="hover:text-orange-500 transition">Beranda</a>
                        <span>/</span>
                        <a href="{{ route('destinations.index') }}" class="hover:text-orange-500 transition">Destinasi</a>
                        <span>/</span>
                        <span class="text-white font-bold">{{ $destination->name }}</span>
                    </nav>

                    <h1 class="text-4xl md:text-6xl font-black text-slate-900 leading-tight uppercase">
                        {{ explode(' ', $destination->name, 2)[0] }}
                        <span class="text-gradient">{{ explode(' ', $destination->name, 2)[1] ?? '' }}</span>
                    </h1>
                    <div class="flex items-center gap-2 text-slate-700">
                        <i class="fa-solid fa-location-dot text-orange-500"></i>
                        <span class="font-medium text-sm">{{ $destination->location }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Main Content Section --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                {{-- Kolom Kiri: Info Utama --}}
                <div class="lg:col-span-2 space-y-12">
                    {{-- Deskripsi --}}
                    <div class="space-y-6">
                        <h2 class="text-3xl font-bold text-slate-900 border-l-4 border-orange-500 pl-4">Tentang Destinasi
                        </h2>
                        <div class="text-slate-600 leading-relaxed text-lg">
                            {!! nl2br(e($destination->description)) !!}
                        </div>
                    </div>

                    {{-- Fasilitas --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 py-8 border-y border-slate-100">
                        @foreach($facilities as $f)
                            @php $item = $iconMap[$f] ?? ['icon' => 'fa-circle-check', 'label' => $f]; @endphp
                            <div class="flex flex-col items-center text-center space-y-2">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-600">
                                    <i class="fa-solid {{ $item['icon'] }} text-xl"></i>
                                </div>
                                <span class="text-[10px] font-bold text-slate-900 uppercase tracking-tighter">
                                    {{ $item['label'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Galeri Foto --}}
                    @if($gallery && count($gallery) > 0)
                        <div class="space-y-6">
                            <h3 class="text-2xl font-bold text-slate-900">Cuplikan Keindahan</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($gallery as $photo)
                                    <img src="{{ asset('storage/' . $photo) }}"
                                        class="rounded-[2rem] w-full h-64 object-cover shadow-md hover:scale-[1.02] transition-transform duration-300">
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Kolom Kanan: Sticky Pricing Card --}}
                <div class="lg:relative">
                    <div class="sticky sticky-booking glass-card p-8 rounded-[3rem] shadow-2xl border border-slate-100">
                        <div class="space-y-6">
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500 font-medium">Harga Mulai</span>
                                <span class="text-2xl font-black text-orange-600">
                                    {{ $destination->price == 0 ? 'GRATIS' : 'Rp ' . number_format($destination->price, 0, ',', '.') }}
                                </span>
                            </div>

                            <hr class="border-slate-100">

                            <div class="space-y-3">
                                <p class="text-xs text-slate-400 text-center italic">Hubungi kami untuk informasi lebih
                                    lanjut atau pemanduan lokal</p>
                                <a href="https://wa.me/6281234567890?text=Halo, saya ingin bertanya tentang destinasi {{ $destination->name }}"
                                    class="w-full bg-slate-900 text-white py-5 rounded-2xl font-bold text-center block hover:bg-orange-600 transition-all uppercase tracking-widest text-xs shadow-lg shadow-slate-200">
                                    Konsultasi Perjalanan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection