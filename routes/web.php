<?php

use Illuminate\Support\Facades\Route;

// routes/web.php
use App\Http\Controllers\{
    DashboardController,
    UserManagementController,
    BarangController,
    PengadaanController,
    PembayaranController,
    VendorController,
    LaporanController,
    InvoiceController
};

Route::get('/', fn() => redirect()->route('dashboard'));

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // STAFF
    Route::middleware('role:staff')->group(function () {
        Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
        Route::post('/users', [UserManagementController::class, 'store'])->name('users.store');
        Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');
        Route::resource('pengadaan', PengadaanController::class)->only(['index', 'create', 'store', 'show']);
        Route::post('/pengadaan/{pengadaan}/selesai', [PengadaanController::class, 'selesai'])->name('pengadaan.selesai');
        Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
        Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
        Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
        Route::get('/invoice/{pengadaan}/preview', [VendorController::class, 'previewInvoice'])
            ->name('vendor.invoice.preview');
    });

    // VENDOR
    Route::middleware('role:vendor')->group(function () {
        Route::resource('barang', BarangController::class)->except(['show']);
        Route::get('/vendor/pengadaan', [VendorController::class, 'index'])->name('vendor.pengadaan.index'); // 2 tabel
        Route::get('/vendor/pembayaran', [VendorController::class, 'pembayaran'])
            ->name('vendor.pembayaran.index');
        Route::post('/vendor/pengadaan/{pengadaan}/approve', [VendorController::class, 'approve'])->name('vendor.pengadaan.approve');
        Route::post('/vendor/pengadaan/{pengadaan}/reject', [VendorController::class, 'reject'])->name('vendor.pengadaan.reject');
        Route::get('/invoice/{pengadaan}', [InvoiceController::class, 'show'])->name('invoice.show'); // invoice lunas
    });

    // KEPALA SEKOLAH
    Route::middleware('role:kepala_sekolah')->group(function () {
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
    });
});
