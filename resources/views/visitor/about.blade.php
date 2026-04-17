@extends('layouts.visitor')

@section('title', 'Tentang Kami - Go Minahasa')

@push('styles')
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-15px) rotate(0.5deg);
            }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        .text-gradient {
            background: linear-gradient(to right, #f97316, #ea580c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Card variatif agar tidak monoton putih */
        .card-about {
            background: linear-gradient(145deg, #ffffff, #f8fafc);
            border: 1px solid rgba(226, 232, 240, 0.5);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-about:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
            border-color: rgba(249, 115, 22, 0.2);
        }
    </style>
@endpush

@section('content')
    {{-- Hero: Header Halaman --}}
    <header class="relative pt-40 pb-24 bg-slate-950 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-[-10%] right-[-5%] w-[600px] h-[600px] bg-orange-600 rounded-full blur-[130px]"></div>
            <div class="absolute bottom-[-10%] left-[-5%] w-[400px] h-[400px] bg-blue-600 rounded-full blur-[130px]"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 text-center">
            <span
                class="inline-block px-5 py-2 mb-6 rounded-full bg-orange-600/10 text-orange-500 border border-orange-500/20 text-xs font-bold tracking-[0.3em] uppercase">
                Warisan & Dedikasi
            </span>
            <h1 class="text-5xl md:text-7xl font-black text-white leading-tight mb-8">
                Membawa Keajaiban Minahasa <br><span class="text-gradient">Ke Mata Dunia.</span>
            </h1>
            <p class="text-gray-400 text-xl max-w-3xl mx-auto leading-relaxed">
                Kami adalah kurator perjalanan eksklusif yang percaya bahwa kemewahan sejati terletak pada keaslian cerita
                dan keindahan alam yang terjaga.
            </p>
        </div>
    </header>

    {{-- Section: Cerita Kami --}}
    <section class="py-24 bg-white relative">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-20 items-center">
                {{-- Visual Komposisi --}}
                <div class="relative group">
                    <div class="relative z-10 rounded-[3rem] overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1590523277543-a94d2e4eb00b?auto=format&fit=crop&q=80"
                            class="w-full h-[600px] object-cover" alt="Budaya Minahasa">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent"></div>
                    </div>
                    {{-- Aksen Dekoratif --}}
                    <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-orange-50 rounded-[3rem] -z-0"></div>

                    <div
                        class="absolute -bottom-6 -right-6 glass p-8 rounded-[2.5rem] shadow-2xl z-20 floating border border-white/50">
                        <div class="text-4xl font-black text-slate-900">100%</div>
                        <div class="text-sm font-bold text-orange-600 uppercase tracking-widest">Autentik & Lokal</div>
                    </div>
                </div>

                {{-- Konten Teks --}}
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-3 text-orange-600 font-bold uppercase text-sm tracking-widest">
                        <span class="w-12 h-[2px] bg-orange-600"></span>
                        Kisah Di Balik Go Minahasa
                    </div>
                    <h2 class="text-4xl font-black text-slate-900 leading-snug">
                        Menemukan Kembali <br><span class="italic text-slate-400">Permata Sulawesi Utara.</span>
                    </h2>
                    <p class="text-gray-500 text-lg leading-relaxed">
                        Go Minahasa lahir dari keinginan untuk menyajikan sisi lain Sulawesi Utara yang belum banyak
                        tersentuh. Kami menggabungkan kenyamanan fasilitas premium dengan kehangatan keramahan lokal untuk
                        menciptakan petualangan yang tak hanya berkesan di foto, tapi juga di hati.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4">
                        <div class="card-about p-8 rounded-[2rem]">
                            <div
                                class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mb-4 text-orange-600 font-bold">
                                01</div>
                            <h4 class="text-xl font-bold text-slate-900 mb-2">Visi Kami</h4>
                            <p class="text-sm text-gray-500 leading-relaxed">Menjadi standar utama pariwisata mewah yang
                                berkelanjutan di Indonesia Timur.</p>
                        </div>
                        <div class="card-about p-8 rounded-[2rem]">
                            <div
                                class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mb-4 text-blue-600 font-bold">
                                02</div>
                            <h4 class="text-xl font-bold text-slate-900 mb-2">Misi Kami</h4>
                            <p class="text-sm text-gray-500 leading-relaxed">Memberdayakan ekonomi lokal melalui wisata
                                berbasis komunitas dan pelestarian alam.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section: Nilai Utama (Soft Background) --}}
    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-80 h-80 bg-orange-200/30 rounded-full blur-[100px]"></div>

        <div class="container mx-auto px-6 text-center relative z-10">
            <h2 class="text-4xl font-black text-slate-900 mb-16">Mengapa Memilih <span class="text-orange-600">Layanan
                    Kami?</span></h2>

            <div class="grid md:grid-cols-4 gap-8">
                {{-- Card 1 --}}
                <div class="card-about p-10 rounded-[3rem] group">
                    <div
                        class="w-16 h-16 bg-white text-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-md group-hover:bg-orange-600 group-hover:text-white transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-slate-900 mb-3">Keamanan Eksklusif</h3>
                    <p class="text-sm text-gray-500">Protokol keamanan ketat untuk setiap petualangan ekstrem maupun santai.
                    </p>
                </div>

                {{-- Card 2 --}}
                <div class="card-about p-10 rounded-[3rem] group">
                    <div
                        class="w-16 h-16 bg-white text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-md group-hover:bg-blue-600 group-hover:text-white transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-slate-900 mb-3">Akses VIP</h3>
                    <p class="text-sm text-gray-500">Izin khusus ke lokasi-lokasi tersembunyi yang tidak dibuka untuk umum.
                    </p>
                </div>

                {{-- Card 3 --}}
                <div class="card-about p-10 rounded-[3rem] group">
                    <div
                        class="w-16 h-16 bg-white text-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-md group-hover:bg-green-600 group-hover:text-white transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-slate-900 mb-3">Kearifan Lokal</h3>
                    <p class="text-sm text-gray-500">Interaksi mendalam dengan adat istiadat dan kuliner asli Minahasa.</p>
                </div>

                {{-- Card 4 --}}
                <div class="card-about p-10 rounded-[3rem] group">
                    <div
                        class="w-16 h-16 bg-white text-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-md group-hover:bg-purple-600 group-hover:text-white transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-slate-900 mb-3">Detail Personalisasi</h3>
                    <p class="text-sm text-gray-500">Setiap rencana perjalanan disesuaikan dengan preferensi unik Anda.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Section: CTA Support --}}
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-4xl mx-auto rounded-[4rem] p-16 bg-slate-900 relative overflow-hidden shadow-2xl">
                <div class="absolute top-0 right-0 w-96 h-96 bg-orange-600/20 blur-[100px]"></div>
                <div class="relative z-10 space-y-8">
                    <h2 class="text-4xl font-black text-white leading-tight">Punya Pertanyaan Khusus Mengenai <br>Rencana
                        Liburan Anda?</h2>
                    <p class="text-slate-400 text-lg">Konsultan perjalanan kami siap membantu menyusun jadwal yang sempurna.
                    </p>
                    <div class="pt-4">
                        <a href="#"
                            class="px-12 py-5 bg-white text-slate-950 rounded-2xl font-black hover:bg-orange-500 hover:text-white transition-all transform hover:scale-105 shadow-xl inline-block">
                            Ngobrol via WhatsApp Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection