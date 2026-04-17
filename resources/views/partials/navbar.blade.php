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

                {{-- Beranda --}}
                <a href="{{ route('landing') }}"
                    class="text-sm font-bold {{ request()->routeIs('landing') ? 'text-orange-600' : 'text-slate-500' }} hover:text-orange-600 transition relative group">
                    Beranda
                    <span
                        class="absolute -bottom-1 left-0 {{ request()->routeIs('landing') ? 'w-full' : 'w-0' }} h-0.5 bg-orange-600 transition-all group-hover:w-full"></span>
                </a>

                {{-- Destinasi - Diperbaiki pengecekan route-nya --}}
                <a href="{{ route('destinations.index') }}"
                    class="text-sm font-bold {{ request()->routeIs('destinations.*') ? 'text-orange-600' : 'text-slate-500' }} hover:text-orange-600 transition relative group">
                    Destinasi
                    <span
                        class="absolute -bottom-1 left-0 {{ request()->routeIs('destinations.*') ? 'w-full' : 'w-0' }} h-0.5 bg-orange-600 transition-all group-hover:w-full"></span>
                </a>

                {{-- Tentang Kami --}}
                <a href="{{ route('about') }}"
                    class="text-sm font-bold {{ request()->routeIs('about') ? 'text-orange-600' : 'text-slate-500' }} hover:text-orange-600 transition relative group">
                    Tentang Kami
                    <span
                        class="absolute -bottom-1 left-0 {{ request()->routeIs('about') ? 'w-full' : 'w-0' }} h-0.5 bg-orange-600 transition-all group-hover:w-full"></span>
                </a>

                {{-- Artikel --}}
                <a href="{{ route('blog.index') }}"
                    class="text-sm font-bold {{ request()->routeIs('blog.*') ? 'text-orange-600' : 'text-slate-500' }} hover:text-orange-600 transition relative group">
                    Artikel
                    <span
                        class="absolute -bottom-1 left-0 {{ request()->routeIs('blog.*') ? 'w-full' : 'w-0' }} h-0.5 bg-orange-600 transition-all group-hover:w-full"></span>
                </a>
            </div>

            {{-- Action Button --}}
            <div
                class="hidden lg:flex items-center gap-4 px-4 py-2 bg-white/5 backdrop-blur-lg border border-white/10 rounded-2xl group hover:border-orange-500/30 transition-all duration-500">
                <div
                    class="flex items-center justify-center w-9 h-9 bg-gradient-to-tr from-orange-600 to-orange-400 rounded-xl shadow-lg shadow-orange-900/20">
                    <i id="weather-icon" class="fa-solid fa-sun text-white text-sm"></i>
                </div>
                <div class="flex flex-col items-start leading-tight">
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-orange-500">Minahasa,
                            ID</span>
                        <span class="flex h-1.5 w-1.5 rounded-full bg-green-500 animate-pulse"></span>
                    </div>
                    <div class="flex items-center gap-2 mt-0.5">
                        <span id="live-clock" class="text-sm font-black text-black tabular-nums">00:00:00</span>
                        <span class="text-white/20 text-xs">|</span>
                        <span class="text-sm font-bold text-gray-500">28°C</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    function updateClock() {
        const now = new Date();
        const options = {
            timeZone: 'Asia/Makassar', // WITA (Minahasa)
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        };

        const timeString = new Intl.DateTimeFormat('en-GB', options).format(now);
        document.getElementById('live-clock').textContent = timeString;

        // Ambil data jam saja untuk logika icon
        const hour = now.toLocaleString('en-GB', { timeZone: 'Asia/Makassar', hour: '2-digit', hour12: false });
        const iconElement = document.getElementById('weather-icon');

        // Logika Pergantian Icon Otomatis
        if (hour >= 6 && hour < 18) {
            // Siang Hari: Icon Matahari (Sun)
            iconElement.className = "fa-solid fa-cloud-sun text-white text-sm animate-pulse";
        } else {
            // Malam Hari: Icon Bulan (Moon)
            iconElement.className = "fa-solid fa-moon text-white text-sm animate-pulse";
        }
    }

    // Jalankan setiap detik
    setInterval(updateClock, 1000);
    updateClock();
</script>

<style>
    .glass {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }
</style>