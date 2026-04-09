<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\pasienController;
use App\Http\Controllers\DashboardPasienController;
use App\Http\Controllers\homepageController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardDokterController;

// Homepage
Route::get('/', [homepageController::class, 'index']);

// Login
Route::get('/login', [loginController::class, 'index']);

// Registrasi
Route::get('/registrasi', function () {
    return view('registrasi');
});

// Pasien
Route::get('/pasien', [pasienController::class, 'index']);

// Dashboard Pasien
Route::get('/dashboard_pasien', [DashboardPasienController::class, 'index']);

// Dashboard Admin
Route::get('/dashboard/admin', [DashboardAdminController::class, 'index'])
    ->name('dashboard.admin');

// Dashboard Dokter
Route::get('/dashboard/dokter', [DashboardDokterController::class, 'index'])
    ->name('dashboard.dokter');