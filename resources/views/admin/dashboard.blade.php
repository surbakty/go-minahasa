@extends('layouts.admin')

@section('header', 'Dashboard Overview')

@section('content')
    {{-- Baris Card Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

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

        {{-- Card 2: Total Editor (Akun Staff) --}}
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

        {{-- Card 3: Total Admin (Akun Administrator) --}}
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

    {{-- Container Grafik Pengunjung --}}
    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm mb-8">
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

        {{-- Canvas Grafik --}}
        <div class="relative h-[350px]">
            <canvas id="visitorChart"></canvas>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Aktivitas Terakhir --}}
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                <h3 class="font-bold text-xl text-slate-900">Aktivitas Terakhir</h3>
                <i class="fa-solid fa-ellipsis text-slate-300"></i>
            </div>
            <div class="p-8">
                <div class="flex flex-col items-center justify-center py-10 text-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 mb-4">
                        <i class="fa-solid fa-clock-rotate-left text-3xl"></i>
                    </div>
                    <p class="text-slate-400 italic text-sm">Belum ada aktivitas terbaru dari sistem.</p>
                </div>
            </div>
        </div>

        {{-- Info Login Saat Ini --}}
        <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white shadow-xl relative overflow-hidden">
            <div class="relative z-10">
                <h3 class="text-xl font-bold mb-2">Halo, {{ auth()->user()->name }}!</h3>
                <p class="text-slate-400 text-sm mb-6">Kamu login sebagai <span
                        class="text-orange-400 font-bold uppercase tracking-widest text-xs">{{ auth()->user()->role }}</span>
                </p>

                <div class="space-y-4">
                    <div class="flex items-center gap-4 bg-white/5 p-4 rounded-2xl border border-white/10">
                        <div class="text-orange-400 text-xl"><i class="fa-solid fa-shield-halved"></i></div>
                        <div>
                            <p class="text-xs text-slate-400 uppercase font-bold">Email Akun</p>
                            <p class="text-sm font-medium">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Hiasan Background --}}
            <div class="absolute -right-10 -bottom-10 opacity-10 text-[10rem] rotate-12">
                <i class="fa-solid fa-microchip"></i>
            </div>
        </div>
    </div>

    {{-- Script Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('visitorChart').getContext('2d');

            // Membuat efek gradien pada grafik
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
                            titleFont: { size: 12, weight: 'bold' },
                            bodyFont: { size: 12 },
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