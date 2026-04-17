@extends('layouts.visitor')

@section('content')
    <article class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                {{-- Breadcrumb --}}
                <nav class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-slate-400 mb-8">
                    <a href="/" class="hover:text-orange-600 transition-colors">Beranda</a>
                    <i class="fa-solid fa-chevron-right text-[8px]"></i>
                    <a href="{{ route('blog.index') }}" class="hover:text-orange-600 transition-colors">Blog</a>
                    <i class="fa-solid fa-chevron-right text-[8px]"></i>
                    <span class="text-slate-800">{{ $post->title }}</span>
                </nav>

                <h1 class="text-3xl md:text-5xl font-black text-slate-900 leading-tight mb-8">
                    {{ $post->title }}
                </h1>

                <div class="flex items-center gap-6 mb-12 border-y border-slate-100 py-6">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($post->author) }}&background=f97316&color=fff"
                            class="w-10 h-10 rounded-full">
                        <div>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-tighter leading-none mb-1">Penulis
                            </p>
                            <p class="text-sm font-bold text-slate-800">{{ $post->author }}</p>
                        </div>
                    </div>
                    <div class="h-10 w-px bg-slate-100"></div>
                    <div>
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-tighter leading-none mb-1">Diterbitkan
                        </p>
                        <p class="text-sm font-bold text-slate-800">{{ $post->created_at->format('d M Y') }}</p>
                    </div>
                </div>

                <img src="{{ asset('storage/' . $post->cover_image) }}" class="w-full h-auto rounded-3xl shadow-2xl mb-12">

                {{-- Isi Konten Artikel --}}
                <div class="prose prose-lg prose-slate max-w-none prose-img:rounded-3xl shadow-slate-200">
                    {!! $post->body !!}
                </div>

                <div class="mt-16 pt-8 border-t border-slate-100">
                    <a href="{{ route('blog.index') }}"
                        class="inline-flex items-center gap-2 text-orange-600 font-bold hover:gap-4 transition-all uppercase tracking-widest text-xs">
                        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Artikel
                    </a>
                </div>
            </div>
        </div>
    </article>
@endsection