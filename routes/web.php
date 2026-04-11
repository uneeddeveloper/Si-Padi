<?php

use App\Http\Controllers\Admin\BerandaAdminController;
use App\Http\Controllers\Admin\PengaduanAdminController;
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

Route::get('/dashboard', [BerandaAdminController::class, 'index'])
    ->middleware('auth')
    ->name('superadmin.dashboard');

Route::get('/admin/pengaduan', [PengaduanAdminController::class, 'index'])
    ->middleware('auth')
    ->name('admin.pengaduan');

Route::get('/admin/pengaduan/{id}', [PengaduanAdminController::class, 'show'])
    ->middleware('auth')
    ->name('admin.pengaduan.show');


// Pastikan menggunakan ->patch sesuai dengan @method('PATCH') di view
Route::patch('/pengaduan/{id}/update-status', [PengaduanAdminController::class, 'updateStatus'])
    ->middleware('auth')
    ->name('admin.pengaduan.updateStatus');

Route::post('/admin/pengaduan/{id}/destroy', [PengaduanAdminController::class, 'destroy'])
    ->middleware('auth')
    ->name('admin.pengaduan.destroy');

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