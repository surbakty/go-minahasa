<nav class="fixed w-full top-6 z-50 px-6">
    <div class="container mx-auto">
        <div class="glass shadow-2xl rounded-[2rem] px-8 py-4 flex justify-between items-center border border-white/20">

            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ route('landing') }}" class="text-2xl font-black tracking-tighter text-slate-900 group">
                    Go <span class="text-orange-600 group-hover:text-orange-500 transition">Minahasa</span>
                </a>
            </div>

            {{-- Menu Navigasi --}}
            <div
                class="hidden md:flex items-center space-x-10 bg-slate-100/50 px-8 py-2 rounded-full border border-slate-200/50">
                <a href="{{ route('landing') }}"
                    class="text-sm font-bold {{ request()->routeIs('landing') ? 'text-orange-600' : 'text-slate-900' }} hover:text-orange-600 transition relative group">
                    Beranda
                    <span
                        class="absolute -bottom-1 left-0 {{ request()->routeIs('landing') ? 'w-full' : 'w-0' }} h-0.5 bg-orange-600 transition-all group-hover:w-full"></span>
                </a>

                {{-- Gunakan ID #explore jika kamu ingin scroll di landing page --}}
                <a href="{{ route('destinasi.index') }}"
                    class="text-sm font-bold {{ request()->routeIs('destinasi.index') ? 'text-orange-600' : 'text-slate-500' }} hover:text-orange-600 transition relative group">
                    Destinasi
                    <span
                        class="absolute -bottom-1 left-0 {{ request()->routeIs('destinasi.index') ? 'w-full' : 'w-0' }} h-0.5 bg-orange-600 transition-all group-hover:w-full"></span>
                </a>

                <a href="{{ route('about') }}"
                    class="text-sm font-bold {{ request()->routeIs('about') ? 'text-orange-600' : 'text-slate-500' }} hover:text-orange-600 transition relative group">
                    Tentang Kami
                    <span
                        class="absolute -bottom-1 left-0 {{ request()->routeIs('about') ? 'w-full' : 'w-0' }} h-0.5 bg-orange-600 transition-all group-hover:w-full"></span>
                </a>
            </div>

            {{-- Action Button --}}
            <div class="flex-shrink-0">
                <a href="/admin"
                    class="group relative inline-flex items-center justify-center px-6 py-2.5 font-bold text-white transition-all duration-200 bg-slate-900 rounded-xl hover:bg-orange-600 focus:outline-none shadow-lg hover:shadow-orange-500/30">
                    <span class="text-sm">Dashboard</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
    .glass {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }
</style>