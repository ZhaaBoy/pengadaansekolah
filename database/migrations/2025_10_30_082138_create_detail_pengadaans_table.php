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
        Schema::create('detail_pengadaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengadaan_id')->constrained('pengadaans')->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
            $table->integer('qty');
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('subtotal', 15, 2);
            $table->string('nama_vendor');      // redundansi utk snapshot saat transaksi
            $table->string('nama_rekening');    // snapshot
            $table->string('no_rekening');      // snapshot
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengadaans');
    }
};
