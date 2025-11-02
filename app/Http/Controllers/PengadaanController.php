<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\{Pengadaan, DetailPengadaan, Barang};

class PengadaanController extends Controller
{
    public function index()
    {
        $list = Pengadaan::with('detail.barang', 'pembayaran')->where('staff_id', auth()->id())->latest()->paginate(12);
        return view('pengadaan.index', compact('list'));
    }
    public function create()
    {
        $barangs = Barang::with('vendor')->orderBy('nama_barang')->get();
        return view('pengadaan.create', compact('barangs'));
    }
    public function store(Request $r)
    {
        $r->validate([
            'barang_id' => 'required|exists:barangs,id',
            'qty' => 'required|integer|min:1'
        ]);

        $barang = Barang::findOrFail($r->barang_id);
        $harga = $barang->harga;
        $subtotal = $harga * (int)$r->qty;

        $pengadaan = Pengadaan::create([
            'staff_id' => auth()->id(),
            'total_harga' => $subtotal,
            'status' => 'menunggu_pembayaran'
        ]);

        DetailPengadaan::create([
            'pengadaan_id' => $pengadaan->id,
            'barang_id' => $barang->id,
            'qty' => $r->qty,
            'harga_satuan' => $harga,
            'subtotal' => $subtotal,
            'nama_vendor' => $barang->vendor->name,
            'nama_rekening' => $barang->nama_rekening,
            'no_rekening' => $barang->no_rekening,
        ]);

        // ✅ Tambahkan otomatis entry pembayaran
        Pembayaran::create([
            'pengadaan_id' => $pengadaan->id,
            'nominal' => $subtotal,
            'status' => 'pending',
            'is_approved' => 'pending',
            'bukti' => null
        ]);

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pengadaan berhasil dibuat dan otomatis masuk ke daftar pembayaran (status: menunggu).');
    }
    public function show(Pengadaan $pengadaan)
    {
        abort_if($pengadaan->staff_id !== auth()->id(), 403);
        $pengadaan->load('detail.barang', 'pembayaran');
        return view('pengadaan.show', compact('pengadaan'));
    }
    public function selesai(Pengadaan $pengadaan)
    {
        abort_if($pengadaan->staff_id !== auth()->id(), 403);
        abort_if($pengadaan->status !== 'dikirim', 403);
        $pengadaan->update(['status' => 'selesai']);
        return back()->with('success', 'Pesanan ditandai selesai.');
    }
}
