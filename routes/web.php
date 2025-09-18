<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AprioriController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'login')->name('login')->middleware("authCheck");
    Route::post('/', 'loginVerification')->name('loginAuth');
    Route::post('/logout', 'logout')->name('logout');
});
Route::middleware("authUser")->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/dashboard/users', UsersController::class);
    Route::resource('/dashboard/role', RoleController::class);
    Route::resource('/dashboard/master-barang', ProdukController::class);
    Route::resource('/dashboard/transaksi-penjualan', PenjualanController::class);
    Route::delete('/dashboard/transaksi-penjualan/destroy-produk/{id}', [PenjualanController::class, 'destroyProduk'])
        ->name('transaksi-penjualan.destroy-produk');
    Route::get('/dashboard/apriori/analyze', [AprioriController::class, 'analyze'])->name('apriori.analyze');

    Route::get('/dashboard/laporan-penjualan', [LaporanPenjualanController::class, 'index'])->name('laporan-penjualan');
    Route::get('/dashboard/laporan-penjualan/{kode_transaksi}', [LaporanPenjualanController::class, 'detail'])->name('laporan-penjualan-detail');
    Route::get('/dashboard/invoice/{kode_transaksi}', [LaporanPenjualanController::class, 'print'])->name('invoice-print');
    Route::get('/dashboard/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat', [ChatController::class, 'ask'])->name('chat.ask');
});
