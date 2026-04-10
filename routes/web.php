<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Beranda\berandaUserController;
use App\Http\Controllers\Beranda\RiwayatController;
use App\Http\Controllers\Beranda\TentangController;
use App\Http\Controllers\Pengaduan\PengaduanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/beranda', [berandaUserController::class, 'index'])
    ->name('beranda');

Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::get('/lacak', [PengaduanController::class, 'lacak'])->name('pengaduan.lacak');

Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');

Route::get('/riwayat-pengaduan', [RiwayatController::class, 'index'])->name('riwayat');