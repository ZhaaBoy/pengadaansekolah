<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pengadaan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Default value supaya tidak error di view
        $data = [
            'total_pengadaan'      => 0,
            'menunggu_pembayaran'  => 0,
            'barang_terbayar'      => 0,
            'pengadaan_terbaru'    => collect(),

            'barang_total'         => 0,
            'barang_dichekout'     => 0,
            'barang_belum_approve' => 0,
            'pembayaran_terbaru'   => collect(),

            'laporan_terbaru'      => collect(),
        ];

        // === STAFF ===
        if ($user->role === 'staff') {
            $data['total_pengadaan'] = Pengadaan::where('staff_id', $user->id)->count();
            $data['menunggu_pembayaran'] = Pengadaan::where('staff_id', $user->id)
                ->where('status', 'menunggu_pembayaran')->count();
            $data['barang_terbayar'] = Pengadaan::where('staff_id', $user->id)
                ->where('status', 'selesai')->count();

            $data['pengadaan_terbaru'] = Pengadaan::with('detail.barang', 'pembayaran')
                ->where('staff_id', $user->id)
                ->latest()->take(5)->get();
        }

        // === VENDOR ===
        if ($user->role === 'vendor') {
            $vendorId = $user->id;

            $data['barang_total'] = Barang::where('user_id', $vendorId)->count();
            $data['barang_dichekout'] = Pengadaan::whereHas('detail.barang', fn($q) => $q->where('user_id', $vendorId))->count();
            $data['barang_belum_approve'] = Pembayaran::whereHas(
                'pengadaan.detail.barang',
                fn($q) => $q->where('user_id', $vendorId)
            )->where('is_approved', 'pending')->count();

            $data['pembayaran_terbaru'] = Pengadaan::with('detail.barang', 'staff', 'pembayaran')
                ->whereHas('detail.barang', fn($q) => $q->where('user_id', $vendorId))
                ->latest()->take(5)->get();
        }

        // === KEPALA SEKOLAH ===
        if ($user->role === 'kepala_sekolah') {
            $data['total_pengadaan'] = Pengadaan::count();
            $data['menunggu_pembayaran'] = Pengadaan::where('status', 'menunggu_pembayaran')->count();
            $data['barang_terbayar'] = Pengadaan::where('status', 'selesai')->count();

            $data['laporan_terbaru'] = Pengadaan::with('detail.barang', 'staff', 'pembayaran')
                ->latest()->take(5)->get();
        }

        return view('dashboard.' . $user->role, $data);
    }
}
