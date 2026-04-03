@extends('layouts.admin')

@section('header', 'Dashboard Overview')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Card Statistik --}}
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
            <p class="text-slate-500 text-sm font-medium mb-1">Total Destinasi</p>
            <h3 class="text-3xl font-black text-slate-900">12</h3>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
            <p class="text-slate-500 text-sm font-medium mb-1">Pesanan Baru</p>
            <h3 class="text-3xl font-black text-orange-600">5</h3>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
            <p class="text-slate-500 text-sm font-medium mb-1">Total User</p>
            <h3 class="text-3xl font-black text-slate-900">128</h3>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-50">
            <h3 class="font-bold text-xl text-slate-900">Aktivitas Terakhir</h3>
        </div>
        <div class="p-8">
            <p class="text-slate-500 italic text-center py-10">Belum ada aktivitas terbaru saat ini.</p>
        </div>
    </div>
@endsection