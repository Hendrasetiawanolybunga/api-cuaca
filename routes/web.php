<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeranController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KebunController;
use App\Http\Controllers\MusimTanamController;
use App\Http\Controllers\PestisidaController;
use App\Http\Controllers\PupukController;
use App\Http\Controllers\DashboardController;

Route::prefix('admin')->group(function () {
    Route::resource('peran', PeranController::class);
    Route::resource('pengguna', PenggunaController::class);
    Route::resource('kebun', KebunController::class);
    Route::resource('musim-tanam', MusimTanamController::class);
    Route::resource('pestisida', PestisidaController::class);
    Route::resource('pupuk', PupukController::class);
});


// Route untuk halaman dashboard utama
Route::get('/', [DashboardController::class, 'index']);

// Route untuk mengambil data cuaca berdasarkan koordinat
Route::get('/get-weather', [DashboardController::class, 'getWeather']);
