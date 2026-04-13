<?php

use App\Http\Controllers\Admin\BerandaAdminController;
use App\Http\Controllers\Admin\InstansiController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\PengaduanAdminController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Beranda\berandaUserController;
use App\Http\Controllers\Beranda\RiwayatController;
use App\Http\Controllers\Beranda\TentangController;
use App\Http\Controllers\Pengaduan\PengaduanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('beranda');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// --- Admin Panel (auth required) ---
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [BerandaAdminController::class, 'index'])->name('dashboard');

    // Pengaduan
    Route::get('/pengaduan', [PengaduanAdminController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/{id}', [PengaduanAdminController::class, 'show'])->name('pengaduan.show');
    Route::patch('/pengaduan/{id}/update-status', [PengaduanAdminController::class, 'updateStatus'])->name('pengaduan.updateStatus');
    Route::delete('/pengaduan/{id}', [PengaduanAdminController::class, 'destroy'])->name('pengaduan.destroy');

    // Masyarakat (Manajemen Akun Admin)
    Route::get('/users', [UserAdminController::class, 'index'])->name('users.index');
    Route::post('/users', [UserAdminController::class, 'store'])->name('users.store');
    Route::patch('/users/{user}/toggle', [UserAdminController::class, 'toggleActive'])->name('users.toggle');
    Route::delete('/users/{user}', [UserAdminController::class, 'destroy'])->name('users.destroy');


    // Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

    // Log Aktivitas (superadmin only)
    Route::get('/log', [LogController::class, 'index'])->name('log.index');

    // Pengaturan (superadmin only)
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan');
});

// Alias lama agar tidak 404 jika masih ada referensi luar
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth')->name('superadmin.dashboard');


// --- Publik (beranda masyarakat) ---
Route::get('/beranda', [berandaUserController::class, 'index'])->name('beranda');
Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::get('/lacak', [PengaduanController::class, 'lacak'])->name('pengaduan.lacak');
Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');
Route::get('/riwayat-pengaduan', [RiwayatController::class, 'index'])->name('riwayat');
