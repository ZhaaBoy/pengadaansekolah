<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    UserManagementController,
    BarangController,
    PengadaanController,
    PembayaranController,
    VendorController,
    LaporanController,
    InvoiceController,
    KepsekPengadaanController
};

Route::get('/', fn() => redirect()->route('dashboard'));

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | STAFF
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:staff')->group(function () {

        // User Management
        Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
        Route::post('/users', [UserManagementController::class, 'store'])->name('users.store');
        Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');

        // Pengadaan
        Route::resource('pengadaan', PengadaanController::class)
            ->only(['index', 'create', 'store', 'show']);

        Route::post(
            '/pengadaan/{pengadaan}/selesai',
            [PengadaanController::class, 'selesai']
        )->name('pengadaan.selesai');

        // Pembayaran (staff upload bukti)
        Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
        Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');

        // ⚠️ TETAP ADA (dipakai view lama)
        Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');

        // Endpoint baru (kalau nanti mau dipakai)
        Route::post(
            '/pengadaan/{pengadaan}/upload-bukti',
            [PembayaranController::class, 'uploadBukti']
        )->name('pengadaan.upload-bukti');

        // Invoice preview (staff)
        Route::get(
            '/invoice/{pengadaan}/preview',
            [VendorController::class, 'previewInvoice']
        )->name('vendor.invoice.preview');
    });

    /*
    |--------------------------------------------------------------------------
    | VENDOR
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:vendor')->group(function () {

        // Barang
        Route::resource('barang', BarangController::class)->except(['show']);

        // Pengadaan vendor
        Route::get(
            '/vendor/pengadaan',
            [VendorController::class, 'index']
        )->name('vendor.pengadaan.index');

        Route::get(
            '/vendor/pembayaran',
            [VendorController::class, 'pembayaran']
        )->name('vendor.pembayaran.index');

        /*
         * ⚠️ NAMA ROUTE TIDAK DIUBAH
         * View masih pakai:
         * route('vendor.pengadaan.approve')
         * route('vendor.pengadaan.reject')
         *
         * Tapi method di controller SUDAH DIGANTI
         */
        Route::post(
            '/vendor/pengadaan/{pengadaan}/approve',
            [VendorController::class, 'terima']
        )->name('vendor.pengadaan.approve');

        Route::post(
            '/vendor/pengadaan/{pengadaan}/reject',
            [VendorController::class, 'tolak']
        )->name('vendor.pengadaan.reject');

        // Invoice vendor
        Route::get(
            '/invoice/{pengadaan}',
            [InvoiceController::class, 'show']
        )->name('invoice.show');
    });

    /*
    |--------------------------------------------------------------------------
    | KEPALA SEKOLAH
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:kepala_sekolah')->group(function () {

        // Approval pengadaan
        Route::get(
            '/kepsek/pengadaan',
            [KepsekPengadaanController::class, 'index']
        )->name('kepsek.pengadaan.index');

        Route::post(
            '/kepsek/pengadaan/{pengadaan}/approve',
            [KepsekPengadaanController::class, 'approve']
        )->name('kepsek.pengadaan.approve');

        Route::post(
            '/kepsek/pengadaan/{pengadaan}/reject',
            [KepsekPengadaanController::class, 'reject']
        )->name('kepsek.pengadaan.reject');

        // Laporan
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
    });
});
