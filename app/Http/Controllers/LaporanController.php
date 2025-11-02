<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengadaan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Pengadaan::with(['detail.barang', 'staff', 'pembayaran'])
            ->where('status', 'selesai');

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        $data = $query->latest()->paginate(10);

        return view('laporan.index', compact('data'));
    }
    public function cetak(Request $r)
    {
        $q = Pengadaan::with('staff', 'pembayaran')->where('status', 'selesai');
        if ($r->filled('from')) $q->whereDate('created_at', '>=', $r->from);
        if ($r->filled('to')) $q->whereDate('created_at', '<=', $r->to);
        $data = $q->get();
        $pdf = Pdf::loadView('laporan.pdf', compact('data'));
        return $pdf->download('laporan-pembayaran.pdf');
    }
}
