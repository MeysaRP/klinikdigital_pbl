<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DashboardPasienController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardDokterController;

// Homepage
Route::get('/', [HomepageController::class, 'index']);

// Login
Route::get('/login', [LoginController::class, 'index']);

// Registrasi
Route::get('/registrasi', function () {
    return view('registrasi');
});

// Pasien
Route::get('/pasien', [PasienController::class, 'index']);

// Dashboard Pasien
Route::get('/dashboard_pasien', [DashboardPasienController::class, 'index']);

// Dashboard Admin
Route::get('/dashboard/admin', [DashboardAdminController::class, 'index'])
    ->name('dashboard.admin');

// Dashboard Dokter
Route::get('/dashboard/dokter', [DashboardDokterController::class, 'index'])
    ->name('dashboard.dokter');