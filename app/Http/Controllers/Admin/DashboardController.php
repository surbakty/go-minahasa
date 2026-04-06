<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman statistik utama admin panel.
     */
    public function index()
    {
        // 1. Menghitung total destinasi wisata
        $totalDestinations = Destination::count();
        
        // 2. Menghitung jumlah Administrator (Felix)
        $totalAdmins = User::where('role', 'admin')->count();

        // 3. Menghitung jumlah Staff Editor
        $totalEditors = User::where('role', 'editor')->count();

        // 4. Placeholder untuk pesanan baru (jika tabel belum ada)
        $totalOrders = 0; 

        // Mengirimkan semua data ke view admin.dashboard
        return view('admin.dashboard', compact(
            'totalDestinations', 
            'totalAdmins', 
            'totalEditors', 
            'totalOrders'
        ));
    }
}