<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\{Pengadaan, Pembayaran};

class VendorController extends Controller
{
    /**
     * Menampilkan daftar pengadaan yang hanya terkait vendor login
     */
    public function index()
    {
        $vendorId = auth()->id();

        // Barang milik vendor ini saja
        $katalog = Barang::where('user_id', $vendorId)->get();

        // Pengadaan yang berisi barang milik vendor ini
        $pengadaan = Pengadaan::with(['detail.barang', 'staff', 'pembayaran'])
            ->whereHas('detail.barang', fn($q) => $q->where('user_id', $vendorId))
            ->latest()
            ->get();

        // pastikan setiap pengadaan memuat relasi pembayaran up to date
        foreach ($pengadaan as $p) {
            $p->loadMissing('pembayaran');
        }

        return view('vendor.pengadaan', compact('katalog', 'pengadaan'));
    }

    /**
     * Vendor membuat barang baru
     */
    public function store(Request $r)
    {
        $r->validate([
            'kode_barang'   => 'required|string|max:50|unique:barangs,kode_barang',
            'nama_barang'   => 'required|string|max:255',
            'harga'         => 'required|numeric|min:0',
            'nama_rekening' => 'required|string|max:100',
            'no_rekening'   => 'required|string|max:100',
        ]);

        Barang::create([
            'user_id'       => auth()->id(),
            'kode_barang'   => strtoupper($r->kode_barang),
            'nama_barang'   => $r->nama_barang,
            'harga'         => $r->harga,
            'nama_rekening' => $r->nama_rekening,
            'no_rekening'   => $r->no_rekening,
        ]);

        return redirect()->route('vendor.pengadaan.index')
            ->with('success', 'Barang baru berhasil ditambahkan ke katalog Anda.');
    }

    /**
     * Approve pembayaran yang masuk hanya jika pengadaan milik vendor ini
     */
    public function approve(Pengadaan $pengadaan)
    {
        $vendorId = auth()->id();

        // Pastikan pengadaan ini memang berisi barang milik vendor yang login
        if (!$pengadaan->detail()->whereHas('barang', fn($q) => $q->where('user_id', $vendorId))->exists()) {
            abort(403, 'Anda tidak berhak mengakses data ini.');
        }

        $payment = $pengadaan->pembayaran;

        if ($payment && $payment->is_approved === 'pending') {
            $payment->update([
                'is_approved' => 'approved',
                'status'      => 'lunas',
            ]);

            $pengadaan->update(['status' => 'dikirim']);

            // Generate invoice PDF
            $pengadaan->load('detail.barang', 'staff', 'pembayaran');
            $pdf = \PDF::loadView('invoice.pdf', compact('pengadaan'));
            $fileName = 'invoice_' . $pengadaan->id . '.pdf';
            $path = 'invoices/' . $fileName;
            \Storage::disk('public')->put($path, $pdf->output());

            // Simpan path invoice
            $payment->update(['invoice_path' => $path]);
            $pengadaan->refresh()->load('pembayaran');
        }

        return back()->with('success', 'Pembayaran disetujui dan status berubah menjadi "Dikirim".');
    }

    /**
     * Reject pembayaran (juga hanya milik vendor ini)
     */
    public function reject(Pengadaan $pengadaan)
    {
        $vendorId = auth()->id();

        if (!$pengadaan->detail()->whereHas('barang', fn($q) => $q->where('user_id', $vendorId))->exists()) {
            abort(403, 'Anda tidak berhak mengakses data ini.');
        }

        $payment = $pengadaan->pembayaran;

        if ($payment && $payment->is_approved === 'pending') {
            $payment->update([
                'is_approved' => 'rejected',
                'status'      => 'rejected',
            ]);

            $pengadaan->update(['status' => 'ditolak']);
            $pengadaan->refresh()->load('pembayaran');
        }

        return back()->with('error', 'Pembayaran ditolak. Status pengadaan & pembayaran berubah menjadi "Ditolak".');
    }

    /**
     * Menampilkan daftar pembayaran (hanya pengadaan vendor ini yang sudah dibayar)
     */
    public function pembayaran()
    {
        $vendorId = auth()->id();

        $pengadaan = Pengadaan::with(['detail.barang', 'staff', 'pembayaran'])
            ->whereHas('detail.barang', fn($q) => $q->where('user_id', $vendorId))
            ->whereHas('pembayaran', fn($q) => $q->whereNotNull('bukti')) // hanya yg sudah dibayar
            ->latest()
            ->get();

        return view('vendor.pembayaran', compact('pengadaan'));
    }

    public function previewInvoice(Pengadaan $pengadaan)
    {
        // Pastikan hanya staff yang bisa akses
        if (auth()->user()->role !== 'staff') {
            abort(403, 'Hanya staff yang dapat melihat invoice ini.');
        }

        // Pastikan pengadaan ini memang milik staff yang login
        if ($pengadaan->staff_id !== auth()->id()) {
            abort(403, 'Anda tidak berhak mengakses invoice ini.');
        }

        // Load relasi yang dibutuhkan
        $pengadaan->load('detail.barang', 'staff', 'pembayaran');

        // Tampilkan langsung view invoice (bukan PDF)
        return view('invoice.pdf', compact('pengadaan'));
    }
}
