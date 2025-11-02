<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'staff') {
            $total = \App\Models\Pengadaan::where('staff_id', $user->id)->sum('total_harga');
            return view('dashboard.staff', compact('total'));
        }
        if ($user->role === 'vendor') {
            $barangs = $user->barangs()->latest()->get();
            return view('dashboard.vendor', compact('barangs'));
        }
        // kepala sekolah
        $count = \App\Models\Pengadaan::where('status', 'selesai')->count();
        return view('dashboard.kepsek', compact('count'));
    }
}
