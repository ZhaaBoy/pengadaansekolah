<?php

namespace App\Http\Controllers;

use App\Models\Pengadaan;
use Illuminate\Http\Request;

class KepsekPengadaanController extends Controller
{
    public function index()
    {
        $pengadaan = Pengadaan::with('detail.barang', 'staff')
            ->orderByRaw("
            CASE
                WHEN status = 'menunggu_approval' THEN 0
                ELSE 1
            END
        ")
            ->orderByDesc('created_at')
            ->get();

        return view('kepsek.pengadaan.index', compact('pengadaan'));
    }

    public function approve(Pengadaan $pengadaan)
    {
        abort_if($pengadaan->status !== 'menunggu_approval', 403);

        $pengadaan->update([
            'status' => 'menunggu_pembayaran',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Pengadaan disetujui.');
    }

    public function reject(Pengadaan $pengadaan)
    {
        abort_if($pengadaan->status !== 'menunggu_approval', 403);

        $pengadaan->update([
            'status' => 'ditolak',
        ]);

        return back()->with('error', 'Pengadaan ditolak.');
    }
}
