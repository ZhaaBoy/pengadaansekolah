<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPengadaan extends Model
{
    protected $fillable = ['pengadaan_id', 'barang_id', 'qty', 'harga_satuan', 'subtotal', 'nama_vendor', 'nama_rekening', 'no_rekening'];
    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class);
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
