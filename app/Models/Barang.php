<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['user_id', 'kode_barang', 'nama_bank', 'nama_barang', 'harga', 'nama_rekening', 'no_rekening'];
    public function vendor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
