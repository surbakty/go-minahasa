@extends('layouts.visitor')

@section('content')
    <div class="h-24 bg-slate-950"></div>

    <div class="py-20 bg-slate-50 min-h-screen">
        <div class="container mx-auto px-6 max-w-4xl">
            <div class="mb-12">
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">
                    Pusat <span class="text-orange-600">Bantuan</span>
                </h1>
                <div class="w-20 h-1.5 bg-orange-600 mt-4 rounded-full"></div>
            </div>

            <div class="grid gap-6">
                {{-- FAQ Item 1 --}}
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-200/60">
                    <h3 class="text-lg font-bold text-slate-900 mb-3 uppercase tracking-wider">Bagaimana cara memesan paket
                        wisata?</h3>
                    <p class="text-slate-600 leading-relaxed">Anda dapat memilih destinasi yang diinginkan, lalu hubungi tim
                        kami melalui tombol WhatsApp yang tersedia di setiap detail destinasi untuk reservasi cepat.</p>
                </div>

                {{-- FAQ Item 2 --}}
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-200/60">
                    <h3 class="text-lg font-bold text-slate-900 mb-3 uppercase tracking-wider">Apakah ada pemandu wisata
                        lokal?</h3>
                    <p class="text-slate-600 leading-relaxed">Ya, Go Minahasa bekerja sama dengan pemandu lokal
                        bersertifikat untuk memastikan pengalaman eksplorasi Anda aman dan informatif.</p>
                </div>

                {{-- Kontak Bantuan --}}
                <div class="bg-orange-600 p-8 rounded-[2rem] shadow-lg text-white">
                    <h3 class="text-xl font-black uppercase italic mb-2">Butuh Bantuan Cepat?</h3>
                    <p class="mb-6 opacity-90">Tim dukungan kami siap melayani Anda 24/7 untuk pertanyaan mendesak.</p>
                    <a href="#"
                        class="inline-block bg-white text-orange-600 px-8 py-3 rounded-xl font-bold uppercase text-xs tracking-widest hover:bg-slate-900 hover:text-white transition">Hubungi
                        Support</a>
                </div>
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