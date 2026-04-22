<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\DashboardPasienController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardDokterController;
use App\Http\Controllers\DataDokterController;

// ================= HALAMAN PUBLIK =================
Route::get('/', [HomepageController::class, 'index'])->name('home');

// ================= AUTH =================
Route::prefix('auth')->group(function () {

    // LOGIN
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.process');

    // REGISTRASI
    Route::get('/registrasi', [RegistrasiController::class, 'index'])->name('registrasi');
    Route::post('/registrasi', [RegistrasiController::class, 'store'])->name('registrasi.store');

    // LUPA PASSWORD
    Route::get('/forgot-password', [LoginController::class, 'forgotForm'])->name('forgot.password');
    Route::post('/forgot-password', [LoginController::class, 'resetPassword'])->name('forgot.process');
});

// ================= LOGOUT =================
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ================= DASHBOARD =================
Route::prefix('dashboard')->group(function () {

    Route::get('/pasien', [DashboardPasienController::class, 'index'])->name('dashboard.pasien');
    Route::get('/admin', [DashboardAdminController::class, 'index'])->name('dashboard.admin');
    Route::get('/dokter', [DashboardDokterController::class, 'index'])->name('dashboard.dokter');

     // DATA DOKTER (BARU)
    Route::get('/data_dokter', [DataDokterController::class, 'index'])->name('data.dokter');

});