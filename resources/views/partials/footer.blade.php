<footer class="relative bg-slate-950 pt-24 pb-12 overflow-hidden">
    {{-- Dekorasi Cahaya --}}
    <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-orange-600/10 rounded-full blur-[100px]"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">

            {{-- Kolom 1: Branding --}}
            <div class="space-y-6">
                <a href="/" class="text-2xl font-black tracking-tighter text-white">
                    Go <span class="text-orange-600">Minahasa</span>
                </a>
                <p class="text-gray-400 leading-relaxed text-sm">
                    Platform eksklusif untuk mengeksplorasi keajaiban alam dan budaya Minahasa dengan standar pelayanan
                    premium.
                </p>
                <div class="flex space-x-4">
                    <a href="#"
                        class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center hover:bg-orange-600 transition-all border border-white/10 group text-xs text-white">FB</a>
                    <a href="#"
                        class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center hover:bg-orange-600 transition-all border border-white/10 group text-xs text-white">IG</a>
                    <a href="#"
                        class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center hover:bg-orange-600 transition-all border border-white/10 group text-xs text-white">YT</a>
                </div>
            </div>

            {{-- Kolom 2: Navigasi --}}
            <div>
                <h4 class="text-white font-bold mb-6 text-sm uppercase tracking-widest">Navigasi</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('landing') }}"
                            class="text-gray-400 hover:text-orange-500 transition text-sm">Beranda</a></li>
                    <li><a href="{{ route('destinations.index') }}"
                            class="text-gray-400 hover:text-orange-500 transition text-sm">Jelajah Destinasi</a></li>
                    <li><a href="{{ route('about') }}"
                            class="text-gray-400 hover:text-orange-500 transition text-sm">Tentang Kami</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Bantuan --}}
            <div>
                <h4 class="text-white font-bold mb-6 text-sm uppercase tracking-widest">Bantuan</h4>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('help') }}"
                            class="text-gray-400 hover:text-orange-500 transition text-sm">Pusat Bantuan</a>
                    </li>
                    <li>
                        <a href="{{ route('terms') }}"
                            class="text-gray-400 hover:text-orange-500 transition text-sm">Syarat & Ketentuan</a>
                    </li>
                    <li>
                        <a href="{{ route('privacy') }}"
                            class="text-gray-400 hover:text-orange-500 transition text-sm">Kebijakan Privasi</a>
                    </li>
                </ul>
            </div>

            {{-- Kolom 4: Newsletter --}}
            <div>
                <h4 class="text-white font-bold mb-6 text-sm uppercase tracking-widest">Berlangganan</h4>
                <p class="text-sm text-gray-400 mb-4">Dapatkan info destinasi tersembunyi setiap minggu.</p>
                <div class="relative">
                    <input type="email" placeholder="Email Anda"
                        class="w-full bg-white/5 border border-white/10 rounded-xl py-3 px-4 text-sm text-white focus:outline-none focus:border-orange-600 transition">
                    <button
                        class="absolute right-2 top-2 bg-orange-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-orange-700 transition">Gabung</button>
                </div>
            </div>
        </div>

        {{-- Bottom Footer (Copyright & Admin Access) --}}
        <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-[10px] font-bold uppercase tracking-[0.3em] text-gray-500">
                &copy; 2026 GO MINAHASA. ALL RIGHTS RESERVED.
            </div>

            <div class="flex items-center gap-8 text-[10px] font-bold uppercase tracking-[0.3em]">
                <span class="text-gray-700 hover:text-gray-500 transition cursor-default">Wonderful Indonesia</span>

                {{-- Link Admin yang Menyamar --}}
                @guest
                    <a href="{{ route('login') }}"
                        class="flex items-center gap-2 group text-gray-600 hover:text-orange-500 transition">
                        <span class="w-1 h-1 rounded-full bg-gray-800 group-hover:bg-orange-500 transition"></span>
                        Admin Access
                    </a>
                @else
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-orange-600">
                    <span class="w-1.5 h-1.5 rounded-full bg-orange-600 animate-ping"></span>
                    Panel Dashboard
                </a>
                @endauth
            </div>
        </div>
    </div>
</footer>

{{-- Shortcut Keyboard untuk Login: Ctrl + Alt + L --}}
<script>
    document.addEventListener('keydown', function (e) {
        // Jika menekan Ctrl + Alt + L
        if (e.ctrlKey && e.altKey && e.key.toLowerCase() === 'l') {
            window.location.href = "{{ route('login') }}";
        }
    });
</script>