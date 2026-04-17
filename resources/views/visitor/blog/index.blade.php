@extends('layouts.visitor')

@section('content')
    <section class="py-16 pt-32 bg-slate-50 min-h-screen">
        <div class="container mx-auto px-4">
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-black text-slate-800 mb-4">Artikel & Kabar Minahasa</h1>
                <p class="text-slate-500 max-w-2xl mx-auto">Temukan tips perjalanan, cerita budaya, dan informasi terbaru
                    seputar Minahasa.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($posts as $post)
                    <div
                        class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 group">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('storage/' . $post->cover_image) }}"
                                class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                            <span
                                class="absolute top-4 left-4 px-4 py-1.5 bg-orange-600 text-white text-[10px] font-bold rounded-full uppercase tracking-widest shadow-lg">
                                {{ $post->category ?? 'Umum' }}
                            </span>
                        </div>
                        <div class="p-8">
                            <div class="flex items-center gap-3 mb-4 text-slate-400 text-xs font-semibold uppercase">
                                <span>{{ $post->created_at->format('d M Y') }}</span>
                                <span>•</span>
                                <span>{{ $post->author }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 mb-4 group-hover:text-orange-600 transition-colors">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="text-slate-500 text-sm leading-relaxed mb-6">
                                {{ $post->excerpt }}
                            </p>
                            <a href="{{ route('blog.show', $post->slug) }}"
                                class="inline-flex items-center gap-2 text-orange-600 font-bold text-sm">
                                Baca Selengkapnya <i class="fa-solid fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <p class="text-slate-400 italic font-medium text-lg text-center">Belum ada artikel yang diterbitkan.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        </div>
    </section>
@endsection