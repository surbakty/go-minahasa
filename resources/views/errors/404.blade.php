@extends('layouts.visitor')

@section('title', '404 - Halaman Tidak Ditemukan')

@section('content')
    <main class="relative min-h-screen flex items-center justify-center overflow-hidden bg-slate-950">
        {{-- Background Glow --}}
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-[20%] left-[30%] w-[400px] h-[400px] bg-orange-600 rounded-full blur-[120px]"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 text-center">
            <div class="space-y-8">
                {{-- Angka 404 Besar --}}
                <h1
                    class="text-[12rem] md:text-[18rem] font-black leading-none text-white/5 select-none absolute inset-0 flex items-center justify-center z-0">
                    404
                </h1>

                <div class="relative z-10">
                    <span
                        class="inline-block px-4 py-2 rounded-full bg-orange-600/10 text-orange-500 border border-orange-500/20 text-sm font-bold tracking-widest uppercase mb-4">
                        Oops! Tersesat?
                    </span>
                    <h2 class="text-4xl md:text-5xl font-black text-white mb-6">
                        Halaman <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-orange-700">Tidak
                            Ditemukan</span>
                    </h2>
                    <p class="text-gray-400 text-lg max-w-md mx-auto leading-relaxed mb-10">
                        Sepertinya kamu melangkah terlalu jauh ke dalam hutan. Mari kembali ke jalan yang benar untuk
                        melanjutkan petualangan.
                    </p>

                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ url('/') }}"
                            class="px-10 py-4 bg-orange-600 hover:bg-orange-700 text-white rounded-2xl font-bold transition-all transform hover:scale-105 shadow-[0_0_30px_rgba(234,88,12,0.3)]">
                            Kembali ke Beranda
                        </a>
                        <button onclick="window.history.back()"
                            class="px-10 py-4 bg-white/5 backdrop-blur-md border border-white/10 text-white rounded-2xl font-bold hover:bg-white/10 transition-all">
                            Sebelumnya
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection