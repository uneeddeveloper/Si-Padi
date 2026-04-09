<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Beranda\berandaUserController;
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