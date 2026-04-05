<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Go Minahasa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-slate-50 font-sans antialiased">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-slate-900 text-slate-300 flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6">
                <h1 class="text-2xl font-black text-white tracking-tighter">Go-Minahasa<span
                        class="text-orange-500">.</span></h1>
            </div>

            <nav class="flex-1 px-4 space-y-2">
                {{-- Menu Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-3 transition-all rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800 text-white border-r-4 border-orange-500 shadow-lg shadow-black/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-orange-500' : 'text-slate-500' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                {{-- Menu Destinasi --}}
                <a href="{{ route('admin.destinations.index') }}"
                    class="flex items-center px-4 py-3 transition-all rounded-xl {{ request()->routeIs('admin.destinations.*') ? 'bg-slate-800 text-white border-r-4 border-orange-500 shadow-lg shadow-black/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.destinations.*') ? 'text-orange-500' : 'text-slate-500' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="font-medium">Destinasi</span>
                </a>
            </nav>

            <div class="p-4 border-t border-slate-800">
                <button
                    class="w-full flex items-center px-4 py-3 text-red-400 hover:bg-red-500/10 rounded-xl transition-all font-medium">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Logout
                </button>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1">
            <header class="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center">
                <h2 class="text-lg font-bold text-slate-800">@yield('header', 'Admin Dashboard')</h2>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-medium text-slate-600">Halo, Admin</span>
                    <div class="w-10 h-10 rounded-full bg-slate-200 border-2 border-white shadow-sm overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=0D1117&color=fff" alt="Avatar">
                    </div>
                </div>
            </header>

            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000,
                borderRadius: '20px'
            });
        @endif
    </script>
</body>

</html>