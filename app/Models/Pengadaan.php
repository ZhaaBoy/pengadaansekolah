<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    protected $fillable = ['staff_id', 'total_harga', 'status'];
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
    public function detail()
    {
        return $this->hasMany(DetailPengadaan::class);
    }
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}
