<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\pasienController;
use App\Http\Controllers\dashboard_pasienController;
use App\Http\Controllers\homepageController; 

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
Route::get('/dashboard_pasien', [dashboard_pasienController::class, 'index']);

// Dashboard Admin
Route::view('/dashboard_admin', 'dashboard_admin');

// Dashboard Dokter
Route::view('/dashboard_dokter', 'dashboard_dokter');