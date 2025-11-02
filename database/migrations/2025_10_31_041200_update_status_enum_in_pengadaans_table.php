<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengadaans', function (Blueprint $table) {
            // tambahkan opsi 'ditolak'
            $table->enum('status', [
                'menunggu_pembayaran',
                'dibayar',
                'dikirim',
                'selesai',
                'ditolak'
            ])->default('menunggu_pembayaran')->change();
        });
    }

    public function down(): void
    {
        Schema::table('pengadaans', function (Blueprint $table) {
            $table->enum('status', [
                'menunggu_pembayaran',
                'dibayar',
                'dikirim',
                'selesai'
            ])->default('menunggu_pembayaran')->change();
        });
    }
};
