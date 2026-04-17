@extends('layouts.admin')

@section('header', 'Dashboard Overview')

@section('content')
    {{-- 1. Baris Card Statistik (Top Row) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Card 1: Total Destinasi --}}
        <div
            class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-5 transition-all hover:shadow-md">
            <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-600 text-2xl">
                <i class="fa-solid fa-map-location-dot"></i>
            </div>
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-1">Total Destinasi</p>
                <h3 class="text-3xl font-black text-slate-900">{{ $totalDestinations }}</h3>
            </div>
        </div>

        {{-- Card 2: Total Editor --}}
        <div
            class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-5 transition-all hover:shadow-md">
            <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 text-2xl">
                <i class="fa-solid fa-user-pen"></i>
            </div>
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-1">Total Editor</p>
                <h3 class="text-3xl font-black text-slate-900">{{ $totalEditors }}</h3>
            </div>
        </div>

        {{-- Card 3: Total Admin --}}
        <div
            class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex items-center gap-5 transition-all hover:shadow-md">
            <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-600 text-2xl">
                <i class="fa-solid fa-users-gear"></i>
            </div>
            <div>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-1">Total Admin</p>
                <h3 class="text-3xl font-black text-slate-900">{{ $totalAdmins }}</h3>
            </div>
        </div>
    </div>

    {{-- 2. Grid Split: Statistik (8) & Info Admin/Aktivitas (4) --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-8">

        {{-- Kolom Kiri: Statistik Pengunjung (8/12) --}}
        <div class="lg:col-span-8 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h3 class="font-bold text-xl text-slate-900">Statistik Pengunjung</h3>
                    <p class="text-slate-400 text-xs mt-1 uppercase tracking-widest">Tren Kunjungan Mingguan (Simulasi)</p>
                </div>
                <span
                    class="text-[10px] bg-green-100 text-green-600 px-4 py-1.5 rounded-full font-black uppercase tracking-tighter transition-all hover:scale-105 cursor-default">
                    <i class="fa-solid fa-arrow-up mr-1"></i> +12% vs Minggu Lalu
                </span>
            </div>

            <div class="relative h-[300px]">
                <canvas id="visitorChart"></canvas>
            </div>
        </div>

        {{-- Kolom Kanan: Info Login & Aktivitas (4/12) --}}
        <div class="lg:col-span-4 flex flex-col gap-6">

            {{-- Card Halo Admin --}}
            <div class="bg-slate-900 p-8 rounded-[2.5rem] relative overflow-hidden text-white shadow-xl">
                <div class="relative z-10">
                    <h3 class="text-xl font-bold mb-1">Halo, {{ auth()->user()->name }}!</h3>
                    <p class="text-slate-400 text-sm mb-6">Kamu login sebagai <span
                            class="text-orange-400 font-bold uppercase tracking-widest text-xs">{{ auth()->user()->role }}</span>
                    </p>

                    <div class="bg-white/5 border border-white/10 p-4 rounded-2xl flex items-center gap-4">
                        <div
                            class="w-10 h-10 rounded-xl bg-orange-500/20 flex items-center justify-center text-orange-500 text-lg">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-[10px] text-slate-500 uppercase font-bold">Email Akun</p>
                            <p class="text-xs truncate font-medium">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>
                <i class="fa-solid fa-microchip absolute -right-6 -bottom-6 text-8xl text-white/5 rotate-12"></i>
            </div>

            {{-- Card Aktivitas Terakhir (Menggunakan flex-1 agar sejajar dengan tinggi grafik) --}}
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm flex-1 flex flex-col">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-sm text-slate-800 uppercase tracking-wider">Aktivitas Terakhir</h3>
                    <div class="w-8 h-8 bg-slate-50 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-clock-rotate-left text-slate-300 text-xs"></i>
                    </div>
                </div>

                <div class="flex-1 flex flex-col items-center justify-center text-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 mb-4">
                        <i class="fa-solid fa-history text-2xl"></i>
                    </div>
                    <p class="text-slate-400 italic text-xs leading-relaxed">Belum ada aktivitas<br>terbaru dari sistem.</p>
                </div>
            </div>

        </div>
    </div>

    {{-- Script Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('visitorChart').getContext('2d');

            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(234, 88, 12, 0.2)');
            gradient.addColorStop(1, 'rgba(234, 88, 12, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                    datasets: [{
                        label: 'Pengunjung',
                        data: [120, 190, 150, 280, 220, 450, 380],
                        borderColor: '#ea580c',
                        borderWidth: 4,
                        fill: true,
                        backgroundColor: gradient,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#ea580c',
                        pointBorderWidth: 3,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            padding: 12,
                            displayColors: false,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f1f5f9', drawBorder: false },
                            ticks: { color: '#94a3b8', font: { size: 11, weight: '600' } }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#94a3b8', font: { size: 11, weight: '600' } }
                        }
                    }
                }
            });
        });
    </script>
@endsection