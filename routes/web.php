<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [PenjualanController::class, 'index'])->name('penjualan.index');
    Route::get('/transaksi/{penjualan}', [PenjualanController::class, 'create'])->name('penjualan.create');
    Route::post('/transaksi/init', [PenjualanController::class, 'init'])->name('penjualan.init');
    Route::post('/transaksi/{penjualan}', [PenjualanController::class, 'store'])->name('penjualan.store');
    Route::put('/transaksi/pelanggan/{penjualan}', [PenjualanController::class, 'updatePelanggan'])->name('penjualan.updatePelanggan');
    Route::put('/transaksi/{detail}', [PenjualanController::class, 'update'])->name('penjualan.update');
    Route::delete('/transaksi/{detail}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
    Route::post('/transaksi/bayar/{penjualan}', [PenjualanController::class, 'bayar'])->name('penjualan.bayar');
    Route::get('/transaksi/nota/{penjualan}', [PenjualanController::class, 'nota'])->name('penjualan.nota');

    Route::get('/produk/addstok', [ProdukController::class, 'addStok'])->name('addstok');
    Route::post('/produk/addstok', [ProdukController::class, 'updateStok'])->name('updatestok');
    Route::resource('/produk', ProdukController::class)->except('show');

    Route::resource('/petugas', UserController::class)->except('show');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');

    Route::resource('/pelanggan', PelangganController::class)->except('show');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
});