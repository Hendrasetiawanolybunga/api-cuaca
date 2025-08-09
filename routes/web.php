<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeranController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KebunController;
use App\Http\Controllers\MusimTanamController;
use App\Http\Controllers\PestisidaController;
use App\Http\Controllers\PupukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Routes - Protected by auth middleware
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('peran', PeranController::class);
    Route::resource('pengguna', PenggunaController::class);
    Route::resource('kebun', KebunController::class);
    Route::resource('musim-tanam', MusimTanamController::class);
    Route::resource('pestisida', PestisidaController::class);
    Route::resource('pupuk', PupukController::class);
});


// Route untuk halaman dashboard utama - Protected by auth middleware
Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

// Route untuk mengambil data cuaca berdasarkan koordinat - Protected by auth middleware
Route::get('/get-weather', [DashboardController::class, 'getWeather'])->middleware('auth');
