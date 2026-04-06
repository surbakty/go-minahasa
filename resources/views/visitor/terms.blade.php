@extends('layouts.visitor')

@section('content')
    <div class="h-24 bg-slate-950"></div>

    <div class="py-20 bg-slate-50 min-h-screen">
        <div class="container mx-auto px-6 max-w-4xl">
            <div class="mb-12">
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">
                    Syarat & <span class="text-orange-600">Ketentuan</span>
                </h1>
                <div class="w-20 h-1.5 bg-orange-600 mt-4 rounded-full"></div>
            </div>

            <div
                class="bg-white p-8 md:p-12 rounded-[2rem] shadow-sm border border-slate-200/60 text-slate-600 leading-relaxed space-y-8">
                <section>
                    <h3 class="text-lg font-bold text-slate-900 mb-3 uppercase tracking-wider">1. Penggunaan Layanan</h3>
                    <p>Dengan mengakses Go Minahasa, Anda setuju untuk mematuhi semua peraturan yang berlaku dan tidak
                        menyalahgunakan informasi destinasi yang kami berikan.</p>
                </section>

                <section>
                    <h3 class="text-lg font-bold text-slate-900 mb-3 uppercase tracking-wider">2. Reservasi & Pembatalan
                    </h3>
                    <p>Setiap reservasi paket wisata melalui platform kami tunduk pada kebijakan pembatalan masing-masing
                        pengelola destinasi yang akan diinformasikan saat konfirmasi.</p>
                </section>

                <section>
                    <h3 class="text-lg font-bold text-slate-900 mb-3 uppercase tracking-wider">3. Hak Kekayaan Intelektual
                    </h3>
                    <p>Seluruh konten foto, deskripsi, dan desain di platform Go Minahasa adalah milik kami dan tidak
                        diizinkan untuk digunakan tanpa izin tertulis.</p>
                </section>
            </div>

            <div class="mt-10">
                <a href="{{ route('landing') }}"
                    class="inline-flex items-center text-sm font-bold text-slate-400 hover:text-orange-600 transition uppercase tracking-widest">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
@endsection