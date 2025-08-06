<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Route untuk halaman dashboard utama
Route::get('/', [DashboardController::class, 'index']);

// Route baru untuk mengambil data cuaca berdasarkan koordinat
Route::get('/get-weather', [DashboardController::class, 'getWeather']);