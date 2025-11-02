<?php

namespace App\Http\Controllers;

use App\Models\Pengadaan;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show(Pengadaan $pengadaan)
    {
        // hanya vendor terkait boleh lihat
        $vendorId = auth()->id();
        $isRelated = $pengadaan->detail()->whereHas('barang', fn($q) => $q->where('user_id', $vendorId))->exists();
        abort_if(!$isRelated, 403);
        $pengadaan->load('detail.barang', 'staff', 'pembayaran');
        return view('invoice.show', compact('pengadaan'));
    }
}
