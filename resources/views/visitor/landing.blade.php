@extends('layouts.visitor')

@section('title', 'Go Minahasa - Luxury Travel Experience')

@push('styles')
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

        .testimonial-card-light {
            background: linear-gradient(145deg, #f8fafc, #ffffff);
        }
    </style>
@endpush

@section('content')
    {{-- Hero Section --}}
    <header class="relative min-h-screen flex items-center overflow-hidden bg-slate-950">
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-orange-600 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[400px] h-[400px] bg-blue-600 rounded-full blur-[120px]">
            </div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8 text-left">
                    <span
                        class="inline-block px-4 py-2 rounded-full bg-orange-600/10 text-orange-500 border border-orange-500/20 text-sm font-bold tracking-widest uppercase">
                        Premium Experience
                    </span>
                    <h1 class="text-6xl lg:text-7xl font-black text-white leading-tight">
                        Jelajahi <span class="text-gradient">Minahasa</span> <br>dengan Gaya.
                    </h1>
                    <p class="text-gray-400 text-xl max-w-lg leading-relaxed">
                        Nikmati perjalanan eksklusif ke jantung Sulawesi Utara. Dari puncak gunung berapi hingga kedalaman
                        laut yang tenang.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#explore"
                            class="px-8 py-4 bg-orange-600 hover:bg-orange-700 text-white rounded-2xl font-bold transition-all transform hover:scale-105 hover:shadow-[0_0_30px_rgba(234,88,12,0.4)]">
                            Mulai Petualangan
                        </a>
                        <button class="px-8 py-4 glass text-white rounded-2xl font-bold hover:bg-white/10 transition-all">
                            Lihat Video
                        </button>
                    </div>
                </div>

                <div class="hidden lg:block relative">
                    <div
                        class="floating w-full h-[500px] rounded-[3rem] overflow-hidden shadow-2xl border-4 border-white/10">
                        <img src="https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&q=80"
                            class="w-full h-full object-cover shadow-inner" alt="Minahasa View">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- Section Fitur --}}
    <section class="py-24 bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-8 text-center">
                <div class="feature-card p-10 rounded-[2.5rem] space-y-6 group hover:shadow-xl transition-all duration-500">
                    <div
                        class="w-20 h-20 bg-orange-100 text-orange-600 rounded-3xl flex items-center justify-center mx-auto group-hover:bg-orange-600 group-hover:text-white transition-all duration-500 shadow-inner">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900">Hidden Gems</h3>
                    <p class="text-gray-500 leading-relaxed">Akses eksklusif ke sudut tersembunyi Minahasa yang jarang
                        terjamah publik.</p>
                </div>
                <div
                    class="feature-card p-10 rounded-[2.5rem] space-y-6 group hover:shadow-xl transition-all duration-500 border-orange-200">
                    <div
                        class="w-20 h-20 bg-blue-100 text-blue-600 rounded-3xl flex items-center justify-center mx-auto group-hover:bg-blue-600 group-hover:text-white transition-all duration-500 shadow-inner">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900">Layanan Personal</h3>
                    <p class="text-gray-500 leading-relaxed">Setiap detail perjalanan Anda disusun secara personal oleh tim
                        ahli kami.</p>
                </div>
                <div class="feature-card p-10 rounded-[2.5rem] space-y-6 group hover:shadow-xl transition-all duration-500">
                    <div
                        class="w-20 h-20 bg-green-100 text-green-600 rounded-3xl flex items-center justify-center mx-auto group-hover:bg-green-600 group-hover:text-white transition-all duration-500 shadow-inner">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900">Keamanan Terjamin</h3>
                    <p class="text-gray-500 leading-relaxed">Kenyamanan dan keselamatan Anda adalah prioritas utama kami.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Section Destinasi Terpilih --}}
    <section id="explore" class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 space-y-4">
                <h2 class="text-4xl font-black text-slate-900">Destinasi <span class="text-orange-600">Terpilih</span></h2>
                <div class="w-24 h-1 bg-orange-600 mx-auto rounded-full"></div>
                <p class="text-gray-500 max-w-md mx-auto">Kurasi tempat wisata terbaik khusus untuk kenyamanan Anda.</p>
            </div>

            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 justify-items-center">
                    @php
                        // Jika database masih kosong, kita buat dummy 3 data untuk preview
                        $displayItems = count($destinations) > 0 ? $destinations->take(3) : range(1, 3);
                    @endphp

                    @foreach($displayItems as $index)
                        <div
                            class="group relative w-full max-w-[350px] h-[480px] rounded-[3rem] overflow-hidden shadow-2xl transition-all duration-700 hover:-translate-y-4">
                            <img src="https://images.unsplash.com/photo-1518548419970-58e3b4079ca1?auto=format&fit=crop&q=80"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                                alt="Destinasi">

                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent"></div>

                            <div class="absolute bottom-8 left-8 right-8 text-white">
                                <p class="text-orange-500 font-bold text-[10px] tracking-widest uppercase mb-2">Terpopuler</p>
                                <h3 class="text-2xl font-black mb-6 leading-tight">Taman Laut Bunaken</h3>

                                <div class="flex items-center justify-between gap-2">
                                    <a href="/destination/bunaken"
                                        class="px-5 py-2.5 bg-white/20 backdrop-blur-md border border-white/30 rounded-full text-xs font-bold hover:bg-orange-600 hover:border-orange-600 transition-all duration-300">
                                        Lihat Detail
                                    </a>
                                    <p class="font-bold text-base whitespace-nowrap">Rp 250.000</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Section Testimonial --}}
    <section class="py-24 bg-slate-50 overflow-hidden relative">
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-50 rounded-full blur-[100px] -z-0"></div>
        <div class="container mx-auto px-6 text-center relative z-10">
            <h2 class="text-4xl font-black text-slate-900 mb-16">Kisah Mereka, <span class="text-orange-600">Perjalanan
                    Anda.</span></h2>
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="testimonial-card-light p-8 rounded-[2.5rem] shadow-sm border border-slate-100 space-y-6">
                        <div class="flex justify-center text-yellow-400 text-sm">★★★★★</div>
                        <p class="text-slate-600 italic leading-relaxed text-lg">"Pengalaman eksklusif. Saya tidak menyangka
                            ada surga seperti ini di Minahasa."</p>
                        <div class="flex items-center justify-center gap-4 pt-6 border-t border-slate-100">
                            <div class="w-12 h-12 rounded-full border-2 border-orange-500 p-0.5"><img
                                    class="w-full h-full rounded-full object-cover" src="https://i.pravatar.cc/150?u=1">
                            </div>
                            <div class="text-left">
                                <h4 class="font-bold text-slate-900">Andini Putri</h4>
                                <p class="text-xs text-gray-400">Travel Enthusiast</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="p-8 rounded-[2.5rem] bg-slate-900 shadow-2xl space-y-6 transform md:scale-110 z-20 border border-slate-800">
                        <div class="flex justify-center text-orange-500 text-sm">★★★★★</div>
                        <p class="text-slate-200 italic leading-relaxed text-lg">"Tim Go Minahasa tahu persis waktu terbaik
                            untuk sampai ke lokasi tanpa keramaian."</p>
                        <div class="flex items-center justify-center gap-4 pt-6 border-t border-slate-700">
                            <div class="w-12 h-12 rounded-full border-2 border-orange-500 p-0.5"><img
                                    class="w-full h-full rounded-full object-cover" src="https://i.pravatar.cc/150?u=2">
                            </div>
                            <div class="text-left">
                                <h4 class="font-bold text-white">Budi Santoso</h4>
                                <p class="text-xs text-slate-400">Photographer</p>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-card-light p-8 rounded-[2.5rem] shadow-sm border border-slate-100 space-y-6">
                        <div class="flex justify-center text-yellow-400 text-sm">★★★★★</div>
                        <p class="text-slate-600 italic leading-relaxed text-lg">"Sangat recommended untuk keluarga.
                            Anak-anak sangat menikmati edukasi budayanya."</p>
                        <div class="flex items-center justify-center gap-4 pt-6 border-t border-slate-100">
                            <div class="w-12 h-12 rounded-full border-2 border-orange-500 p-0.5"><img
                                    class="w-full h-full rounded-full object-cover" src="https://i.pravatar.cc/150?u=3">
                            </div>
                            <div class="text-left">
                                <h4 class="font-bold text-slate-900">Jessica Wijaya</h4>
                                <p class="text-xs text-gray-400">Family Traveler</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section CTA --}}
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="relative rounded-[4rem] overflow-hidden bg-slate-900 p-12 md:p-24 text-center shadow-2xl">
                <div class="absolute top-0 left-0 w-96 h-96 bg-orange-600/20 blur-[120px]"></div>
                <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-600/10 blur-[120px]"></div>
                <div class="relative z-10 space-y-8">
                    <h2 class="text-4xl md:text-6xl font-black text-white">Siap Menulis Cerita Baru?</h2>
                    <p class="text-slate-400 max-w-2xl mx-auto text-lg leading-relaxed">Bergabunglah dengan ratusan
                        penjelajah yang telah menemukan keajaiban sejati bersama layanan eksklusif kami.</p>
                    <div class="pt-6">
                        <a href="#"
                            class="px-12 py-5 bg-white text-slate-950 rounded-2xl font-black hover:bg-orange-500 hover:text-white transition-all shadow-xl inline-block transform hover:scale-105">
                            Konsultasi Gratis Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection