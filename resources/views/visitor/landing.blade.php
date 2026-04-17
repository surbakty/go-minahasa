@extends('layouts.visitor')

@section('title', 'Go Minahasa')

@push('styles')
    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(1deg);
            }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        .glass {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .text-gradient {
            background: linear-gradient(to right, #f97316, #ea580c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .feature-card {
            background: linear-gradient(145deg, #ffffff, #f1f5f9);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        /* Swiper Custom Pagination */
        .swiper-pagination-bullet-active {
            background: #f97316 !important;
        }

        .gallerySwiper .swiper-slide {
            height: auto;
        }

        /* Hover effect for navigation arrows */
        .group-swiper:hover .nav-btn {
            opacity: 1;
        }
    </style>
@endpush

@section('content')
    {{-- Hero Section --}}
    <header class="relative min-h-screen flex items-center justify-center overflow-hidden bg-slate-950">
        {{-- Background Image dengan Animasi Slow Zoom --}}
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1590523277543-a94d2e4eb00b?auto=format&fit=crop&q=80"
                class="w-full h-full object-cover animate-slow-zoom" alt="Background Pantai Minahasa">

            {{-- Overlay Gradasi --}}
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/70 via-slate-950/40 to-slate-950/80"></div>
        </div>

        {{-- Dekorasi Cahaya --}}
        <div class="absolute inset-0 opacity-20 z-0">
            <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-orange-600 rounded-full blur-[150px]"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 text-center">
            <div class="max-w-4xl mx-auto space-y-8" data-aos="zoom-in" data-aos-duration="1000">
                <span
                    class="inline-block px-4 py-2 rounded-full bg-orange-600/20 text-orange-400 border border-orange-500/30 text-xs font-black tracking-[0.2em] uppercase">
                    Welcome to North Sulawesi
                </span>

                <h1 class="text-5xl lg:text-8xl font-black text-white leading-tight">
                    Jelajahi Pesona <br>
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-orange-300">Minahasa</span>
                </h1>

                <p class="text-gray-200 text-lg lg:text-xl max-w-2xl mx-auto leading-relaxed font-medium drop-shadow-md">
                    Nikmati perjalanan tak terlupakan ke jantung Sulawesi Utara. Dari keajaiban bawah laut hingga hamparan
                    pegunungan yang memukau, semua ada di sini.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                    <a href="{{ route('destinations.index') }}"
                        class="group relative px-7 py-3.5 bg-orange-600 hover:bg-orange-700 text-white rounded-xl font-bold uppercase text-xs tracking-widest transition-all shadow-md shadow-orange-900/10 active:scale-95">
                        Mulai Petualangan
                        <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce text-white/30">
            <i class="fa-solid fa-chevron-down text-2xl"></i>
        </div>
    </header>

    <style>
        /* Keyframe untuk efek Zoom-In & Zoom-Out halus */
        @keyframes slowZoom {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(1.1);
            }
        }

        .animate-slow-zoom {
            animation: slowZoom 15s ease-in-out infinite alternate;
        }
    </style>

    {{-- Section Destinasi Terpilih - Versi Lebih Compact --}}
    <section id="explore" class="py-16 bg-white"> {{-- py-24 dikurangi ke py-16 agar lebih slim --}}
        <div class="container mx-auto px-6">
            <div class="text-center mb-12 space-y-3" data-aos="fade-down" data-aos-duration="700">
                <h2 class="text-3xl font-black text-slate-900">Destinasi <span class="text-orange-600">Terpilih</span></h2>
                <div class="w-20 h-1 bg-orange-600 mx-auto rounded-full"></div>
                <p class="text-gray-500 text-sm max-md mx-auto">Kurasi tempat wisata terbaik khusus untuk Anda.</p>
            </div>

            {{-- Grid tetap 3 kolom, namun max-w kontainer diperkecil --}}
            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 justify-items-center">
                @forelse($destinations->take(3) as $destination)
                    {{-- max-w dikurangi ke 300px dan tinggi ke 400px --}}
                    <div class="group relative w-full max-w-[300px] h-[400px] rounded-[2.5rem] overflow-hidden shadow-xl transition-all duration-700 hover:-translate-y-3"
                        data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}" data-aos-duration="700">

                        <img src="{{ $destination->cover_image ? asset('storage/' . $destination->cover_image) : 'https://images.unsplash.com/photo-1518548419970-58e3b4079ca1?auto=format&fit=crop&q=80' }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                            alt="{{ $destination->name }}">

                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/20 to-transparent"></div>

                        <div class="absolute bottom-6 left-6 right-6 text-white">
                            {{-- Ukuran font judul dikurangi ke text-xl --}}
                            <h3 class="text-xl font-black mb-4 leading-tight">{{ $destination->name }}</h3>

                            <div class="flex items-center justify-between gap-2">
                                {{-- Padding tombol diperkecil --}}
                                <a href="{{ route('destinations.show', $destination->slug) }}"
                                    class="px-4 py-2 bg-white/20 backdrop-blur-md border border-white/30 rounded-full text-[10px] font-bold hover:bg-orange-600 hover:border-orange-600 transition-all duration-300">
                                    Lihat Detail
                                </a>
                                <p class="font-bold text-sm whitespace-nowrap">
                                    {{ $destination->price > 0 ? 'Rp ' . number_format($destination->price, 0, ',', '.') : 'Gratis' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 col-span-3 text-center">Belum ada destinasi yang tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Section Gallery (Carousel Version) - Versi Slim & Center --}}
    <section class="py-12 bg-white overflow-hidden">
        <div class="container mx-auto px-6">
            {{-- Header Galeri: Judul di Tengah --}}
            <div class="text-center mb-8" data-aos="fade-up" data-aos-duration="700">
                <h2 class="text-3xl font-black text-slate-900">Sudut <span class="text-orange-600">Minahasa</span></h2>
                <div class="w-16 h-1 bg-orange-600 mt-2 mx-auto rounded-full"></div>
                <p class="text-gray-500 mt-3 text-sm max-w-lg mx-auto">Momen autentik dari berbagai sudut tanah Minahasa.
                </p>
            </div>

            <div class="relative group-swiper">
                {{-- Swiper Container: Aspect Square (1:1) agar card lebih kecil --}}
                <div class="swiper gallerySwiper px-4" data-aos="fade-up" data-aos-delay="200" data-aos-duration="700">
                    <div class="swiper-wrapper">
                        @foreach($galleries as $gallery)
                            <div class="swiper-slide py-2">
                                <div
                                    class="group relative overflow-hidden rounded-[2rem] aspect-square bg-slate-100 shadow-sm transition-all duration-500 hover:shadow-xl hover:-translate-y-1">
                                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                                        class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                                        <p class="text-white font-bold text-sm leading-tight">
                                            {{ $gallery->title }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Navigasi: Floating di sisi slider --}}
                <button
                    class="gallery-prev nav-btn absolute left-0 top-1/2 -translate-y-1/2 -translate-x-2 z-10 w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center text-slate-400 hover:text-orange-600 transition-all opacity-0 md:opacity-0">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button
                    class="gallery-next nav-btn absolute right-0 top-1/2 -translate-y-1/2 translate-x-2 z-10 w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center text-slate-400 hover:text-orange-600 transition-all opacity-0 md:opacity-0">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

    {{-- Section Testimonial --}}
    <section class="py-24 bg-slate-50 overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-down" data-aos-duration="700">
                <h2 class="text-4xl font-black text-slate-900">Kisah <span class="text-orange-600">Pengunjung</span></h2>
                <p class="text-gray-500 mt-4">Apa kata mereka tentang pengalaman bersama Go Minahasa.</p>
            </div>

            <div class="swiper testimonialSwiper pb-12">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $t)
                        <div class="swiper-slide h-auto">
                            <div
                                class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 h-full flex flex-col transition-all hover:shadow-xl">
                                <div class="flex items-center gap-4 mb-6">
                                    <img src="{{ $t->photo ? asset('storage/' . $t->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($t->name) }}"
                                        class="w-14 h-14 rounded-full object-cover border-2 border-orange-500 p-0.5"
                                        alt="{{ $t->name }}">
                                    <div>
                                        <h4 class="font-bold text-slate-800">{{ $t->name }}</h4>
                                        <p class="text-sm text-slate-500">{{ $t->profession ?? 'Traveler' }}</p>
                                    </div>
                                </div>
                                <div class="flex text-orange-400 mb-4 gap-1">
                                    @for($i = 0; $i < $t->rating; $i++)
                                        <i class="fas fa-star text-[10px]"></i>
                                    @endfor
                                </div>
                                <p class="text-slate-600 leading-relaxed italic text-sm flex-grow">
                                    "{{ $t->content }}"
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination !bottom-0"></div>
            </div>
        </div>
    </section>

    {{-- Section MAPS --}}
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12" data-aos="fade-down" data-aos-duration="700">
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-4">Eksplorasi Minahasa</h2>
                <p class="text-slate-500 max-w-2xl mx-auto text-lg">Temukan lokasi destinasi impianmu di seluruh wilayah
                    Kabupaten Minahasa.</p>
            </div>

            <div class="relative rounded-[4rem] overflow-hidden bg-slate-900 p-4 shadow-2xl" data-aos="zoom-in"
                data-aos-duration="700">
                <div class="absolute top-0 left-0 w-96 h-96 bg-orange-600/20 blur-[120px]"></div>
                <div class="z-10 w-full h-[500px] rounded-[3rem] overflow-hidden border border-white/10 relative">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d255314.4132473347!2d124.71261314815197!3d1.1332824905183317!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32873ec875c742c3%3A0x3030303030303030!2sMinahasa%20Regency%2C%20North%20Sulawesi!5e0!3m2!1sen!2sid!4v1713165000000!5m2!1sen!2sid"
                        class="w-full h-full border-0" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{-- Swiper JS --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Testimonial Swiper
            new Swiper(".testimonialSwiper", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: { delay: 5000, disableOnInteraction: false },
                pagination: { el: ".swiper-pagination", clickable: true },
                breakpoints: {
                    640: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 },
                },
            });

            // Gallery Swiper - Dibuat lebih padat (5 slide di desktop)
            new Swiper(".gallerySwiper", {
                slidesPerView: 2.2,
                spaceBetween: 15,
                loop: true,
                grabCursor: true,
                navigation: {
                    nextEl: ".gallery-next",
                    prevEl: ".gallery-prev",
                },
                breakpoints: {
                    640: { slidesPerView: 3.2, spaceBetween: 20 },
                    1024: { slidesPerView: 5.2, spaceBetween: 25 },
                },
            });
        });
    </script>
@endpush