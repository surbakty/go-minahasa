<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Go-Minahasa Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Tambahkan script Alpine.js di sini --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .bg-pattern {
            background-color: #f8fafc;
            background-image: radial-gradient(#ea580c 0.5px, transparent 0.5px), radial-gradient(#ea580c 0.5px, #f8fafc 0.5px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            opacity: 0.05;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-slate-50 flex items-center justify-center min-h-screen relative overflow-hidden">
    {{-- Background Decor --}}
    <div class="absolute inset-0 bg-pattern"></div>
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-orange-100 rounded-full blur-3xl opacity-50"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-orange-200 rounded-full blur-3xl opacity-50"></div>

    <div class="relative w-full max-w-md px-6">
        <div class="bg-white/80 backdrop-blur-xl border border-white p-10 rounded-[2.5rem] shadow-2xl">
            {{-- Logo & Header --}}
            <div class="text-center mb-10">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-tr from-orange-600 to-orange-400 rounded-2xl shadow-lg shadow-orange-200 mb-4">
                    <i class="fa-solid fa-shield-halved text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Pustopia <span
                        class="text-orange-600">Panel</span></h2>
                <p class="text-slate-500 text-sm mt-2 font-medium">Silakan masuk untuk mengelola Go Minahasa</p>
            </div>

            {{-- Alert Error --}}
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl flex items-center gap-3">
                    <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                    <p class="text-red-700 text-xs font-bold">{{ $errors->first() }}</p>
                </div>
            @endif

            {{-- Form Login --}}
            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-black text-slate-700 uppercase tracking-widest mb-2 ml-1">Email
                        Admin</label>
                    <div class="relative group">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-orange-500 transition-colors">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full pl-12 pr-4 py-4 bg-slate-100 border-transparent border-2 focus:border-orange-500 focus:bg-white rounded-2xl outline-none transition-all text-sm font-medium"
                            placeholder="admin@example.com">
                    </div>
                </div>

                {{-- Input Password dengan Fitur Show/Hide --}}
                <div x-data="{ show: false }">
                    <label
                        class="block text-xs font-black text-slate-700 uppercase tracking-widest mb-2 ml-1">Password</label>
                    <div class="relative group">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 group-focus-within:text-orange-500 transition-colors">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input :type="show ? 'text' : 'password'" name="password" required
                            class="w-full pl-12 pr-12 py-4 bg-slate-100 border-transparent border-2 focus:border-orange-500 focus:bg-white rounded-2xl outline-none transition-all text-sm font-medium"
                            placeholder="••••••••">

                        {{-- Tombol Mata --}}
                        <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-orange-500 transition-colors">
                            <i class="fa-solid" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-slate-900 text-white py-4 rounded-2xl font-black text-sm uppercase tracking-[0.2em] hover:bg-orange-600 shadow-xl shadow-slate-200 hover:shadow-orange-200 transition-all active:scale-[0.98]">
                        Masuk Sekarang
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <a href="/"
                    class="text-xs font-bold text-slate-400 hover:text-orange-600 transition-colors uppercase tracking-widest">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Website
                </a>
            </div>
        </div>

        <p class="text-center mt-8 text-slate-400 text-[10px] font-bold uppercase tracking-[0.3em]">
            &copy; 2026 Go Minahasa • Built with Love
        </p>
    </div>
</body>

</html>