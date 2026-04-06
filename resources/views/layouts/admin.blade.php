<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Go Minahasa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-slate-50 font-sans antialiased">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-slate-900 text-slate-300 flex-shrink-0 hidden md:flex flex-col shadow-2xl">
            <div class="p-6">
                <h1 class="text-2xl font-black text-white tracking-tighter italic">Go-Minahasa<span
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
                    <span class="font-medium text-sm">Dashboard</span>
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
                    <span class="font-medium text-sm">Destinasi</span>
                </a>

                {{-- MENU KHUSUS ADMIN (Felix) --}}
                @if(Auth::user() && Auth::user()->role === 'admin')
                    <div class="pt-4 pb-2">
                        <p class="px-4 text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em]">Management</p>
                    </div>
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center px-4 py-3 transition-all rounded-xl {{ request()->routeIs('admin.users.*') ? 'bg-slate-800 text-white border-r-4 border-orange-500 shadow-lg shadow-black/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
                        <i
                            class="fa-solid fa-users-gear w-5 mr-3 text-sm {{ request()->routeIs('admin.users.*') ? 'text-orange-500' : 'text-slate-500' }}"></i>
                        <span class="font-medium text-sm">Kelola Staff</span>
                    </a>
                @endif
            </nav>

            {{-- Bagian Logout --}}
            <div class="p-4 border-t border-slate-800">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center px-4 py-3 text-red-400 hover:bg-red-500/10 rounded-xl transition-all font-bold group">
                        <svg class="w-5 h-5 mr-3 transition-transform group-hover:-translate-x-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1">
            <header
                class="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center sticky top-0 z-10">
                <h2 class="text-lg font-bold text-slate-800 uppercase tracking-tight">
                    @yield('header', 'Admin Dashboard')</h2>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="text-sm font-black text-slate-800 leading-none">{{ Auth::user()->name ?? 'Admin' }}
                        </p>
                        {{-- Label Role Dinamis --}}
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">
                            {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Staff Editor' }}
                        </p>
                    </div>
                    <div
                        class="w-10 h-10 rounded-xl bg-slate-100 border-2 border-white shadow-sm overflow-hidden flex items-center justify-center">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'A') }}&background=0D1117&color=fff"
                            alt="Avatar">
                    </div>
                </div>
            </header>

            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>

    {{-- SweetAlert & Global Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    popup: 'rounded-[2rem]'
                }
            });
        @endif
    </script>
</body>

</html>