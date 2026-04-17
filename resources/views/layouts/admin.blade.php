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
        <aside class="w-72 bg-slate-900 text-slate-300 flex-shrink-0 hidden md:flex flex-col shadow-2xl">
            <div class="p-8">
                <h1 class="text-2xl font-black text-white tracking-tighter italic">Go-Minahasa<span
                        class="text-orange-500">.</span></h1>
            </div>

            <nav class="flex-1 px-4 flex flex-col gap-8 overflow-y-auto custom-scrollbar">

                <div>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4 ml-4">Main</p>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-orange-600/10 text-orange-500 font-bold border border-orange-500/20 shadow-lg shadow-orange-900/10' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                                <i class="fa-solid fa-house-chimney w-5 text-sm"></i>
                                <span class="text-sm">Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4 ml-4">Wisata &
                        Konten</p>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('admin.destinations.index') }}"
                                class="group flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('admin.destinations.*') ? 'bg-orange-600/10 text-orange-500 font-bold border border-orange-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                                <i
                                    class="fa-solid fa-map-location-dot w-5 text-sm {{ request()->routeIs('admin.destinations.*') ? 'text-orange-500' : 'group-hover:text-orange-500' }}"></i>
                                <span class="text-sm">Destinasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories.index') }}"
                                class="group flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('admin.categories.*') ? 'bg-orange-600/10 text-orange-500 font-bold border border-orange-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                                <i
                                    class="fa-solid fa-tags w-5 text-sm {{ request()->routeIs('admin.categories.*') ? 'text-orange-500' : 'group-hover:text-orange-500' }}"></i>
                                <span class="text-sm">Kategori Wisata</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.posts.index') }}"
                                class="group flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('admin.posts.*') ? 'bg-orange-600/10 text-orange-500 font-bold border border-orange-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                                <i
                                    class="fa-solid fa-newspaper w-5 text-sm {{ request()->routeIs('admin.posts.*') ? 'text-orange-500' : 'group-hover:text-orange-500' }}"></i>
                                <span class="text-sm">Blog / Artikel</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.galleries.index') }}"
                                class="group flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('admin.galleries.*') ? 'bg-orange-600/10 text-orange-500 font-bold border border-orange-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                                <i
                                    class="fa-solid fa-images w-5 text-sm {{ request()->routeIs('admin.galleries.*') ? 'text-orange-500' : 'group-hover:text-orange-500' }}"></i>
                                <span class="text-sm">Galeri Wisata</span>
                            </a>
                        </li>
                    </ul>
                </div>

                @if(auth()->user()->role == 'admin')
                    <div>
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4 ml-4">Management</p>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('admin.testimonials.index') }}"
                                    class="group flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('admin.testimonials.*') ? 'bg-orange-600/10 text-orange-500 font-bold border border-orange-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                                    <i
                                        class="fa-solid fa-comment-dots w-5 text-sm {{ request()->routeIs('admin.testimonials.*') ? 'text-orange-500' : 'group-hover:text-orange-500' }}"></i>
                                    <span class="text-sm">Testimonial</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.index') }}"
                                    class="group flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('admin.users.*') ? 'bg-orange-600/10 text-orange-500 font-bold border border-orange-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                                    <i
                                        class="fa-solid fa-users-gear w-5 text-sm {{ request()->routeIs('admin.users.*') ? 'text-orange-500' : 'group-hover:text-orange-500' }}"></i>
                                    <span class="text-sm">Kelola Staff</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif
            </nav>

            {{-- Bagian Logout --}}
            <div class="p-6 border-t border-slate-800/50">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-3 text-red-400 hover:bg-red-500/10 rounded-2xl transition-all font-bold group">
                        <i class="fa-solid fa-right-from-bracket transition-transform group-hover:-translate-x-1"></i>
                        <span class="text-sm">Logout System</span>
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
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">
                            {{ auth()->user()->role == 'admin' ? 'Administrator' : 'Staff Editor' }}
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
                customClass: { popup: 'rounded-[2rem]' }
            });
        @endif
    </script>
</body>

</html>