<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Pengadaan, Pembayaran};
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function create()
    {
        $pengadaans = Pengadaan::with('detail.barang')->where('staff_id', auth()->id())
            ->where('status', 'menunggu_pembayaran')->get();
        return view('pembayaran.create', compact('pengadaans'));
    }
    public function index()
    {
        $pengadaan = Pengadaan::with(['detail.barang', 'pembayaran'])
            ->where('staff_id', auth()->id())
            ->whereIn('status', ['menunggu_pembayaran', 'dibayar', 'dikirim', 'selesai'])
            ->orderByRaw("
            CASE
                WHEN status = 'menunggu_pembayaran' THEN 0
                ELSE 1
            END
        ")
            ->latest()
            ->get();

        return view('pembayaran.index', [
            'pembayaran' => $pengadaan
        ]);
    }

    public function store(Request $r)
    {
        $r->validate([
            'pengadaan_id' => 'required|exists:pengadaans,id',
            'bukti' => 'required|image|max:2048',
        ]);

        $pengadaan = Pengadaan::findOrFail($r->pengadaan_id);
        abort_if($pengadaan->staff_id != auth()->id(), 403);

        // Simpan file bukti transfer
        $path = $r->file('bukti')->store('bukti-transfer', 'public');

        $bayar = Pembayaran::updateOrCreate(
            ['pengadaan_id' => $pengadaan->id],
            [
                'nominal' => $pengadaan->total_harga,
                'bukti' => $path,
                'status' => 'pending',
                'is_approved' => 'pending'
            ]
        );

        $pengadaan->update(['status' => 'dibayar']);

        return back()->with('success', 'Bukti transfer berhasil diupload dan menunggu konfirmasi vendor.');
    }

    public function uploadBukti(Request $r, Pengadaan $pengadaan)
    {
        abort_if($pengadaan->staff_id !== auth()->id(), 403);
        abort_if($pengadaan->status !== 'menunggu_pembayaran', 403);

        $r->validate([
            'bukti' => 'required|image|max:2048'
        ]);

        $path = $r->file('bukti')->store('bukti-transfer', 'public');

        Pembayaran::create([
            'pengadaan_id' => $pengadaan->id,
            'nominal' => $pengadaan->total_harga,
            'bukti' => $path,
            'status' => 'pending',
        ]);

        $pengadaan->update(['status' => 'dibayar']);

        return back()->with('success', 'Bukti transfer berhasil diupload.');
    }
}
