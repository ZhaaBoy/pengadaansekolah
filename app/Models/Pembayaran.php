<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = ['pengadaan_id', 'nominal', 'bukti', 'status', 'is_approved', 'invoice_path', 'metode'];
    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class);
    }
}
