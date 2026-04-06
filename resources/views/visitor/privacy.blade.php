@extends('layouts.visitor')

@section('content')
    <div class="pt-32 pb-20 bg-slate-50 min-h-screen">
        <div class="container mx-auto px-6 max-w-4xl">
            <h1 class="text-4xl font-black text-slate-900 mb-8">Kebijakan <span class="text-orange-600">Privasi</span></h1>

            <div
                class="prose prose-slate lg:prose-lg bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 text-slate-600 leading-relaxed">
                <p class="mb-4">Terakhir diperbarui: {{ date('d F Y') }}</p>

                <h3 class="text-xl font-bold text-slate-800 mt-8 mb-4">1. Informasi yang Kami Kumpulkan</h3>
                <p>Kami mengumpulkan informasi minimal untuk memberikan pengalaman terbaik dalam menjelajahi destinasi di
                    Minahasa...</p>

                <h3 class="text-xl font-bold text-slate-800 mt-8 mb-4">2. Penggunaan Data</h3>
                <p>Data yang dikumpulkan hanya digunakan untuk pengembangan layanan Go Minahasa dan tidak akan
                    diperjualbelikan kepada pihak ketiga.</p>

                {{-- Tambahkan teks lainnya di sini --}}
            </div>

            <div class="mt-12">
                <a href="{{ route('landing') }}" class="text-orange-600 font-bold hover:underline">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
@endsection