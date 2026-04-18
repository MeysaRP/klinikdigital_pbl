<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DashboardPasienController;
use App\Http\Controllers\homepageController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardDokterController;
use App\Http\Controllers\RegistrasiController;

// ================= HOMEPAGE =================
Route::get('/', [homepageController::class, 'index']);


// ================= LOGIN =================
Route::get('/login', [LoginController::class, 'index'])->name('login');

// 👉 LOGIN SEMENTARA (DUMMY FRONTEND)
Route::post('/login', function () {
    return redirect('/dashboard_pasien')->with('success', 'Login berhasil (dummy)');
})->name('login.process');


// ================= LOGOUT =================
Route::post('/logout', function () {
    return redirect('/login');
})->name('logout');


// ================= LUPA PASSWORD =================
Route::get('/forgot-password', [LoginController::class, 'forgotForm'])->name('forgot.password');

// dummy reset
Route::post('/forgot-password', function () {
    return redirect('/login')->with('success', 'Password berhasil diubah (dummy)');
})->name('forgot.process');


// ================= REGISTRASI =================
Route::get('/registrasi', [RegistrasiController::class, 'index'])->name('registrasi');

// dummy register
Route::post('/registrasi', function () {
    return redirect('/login')->with('success', 'Registrasi berhasil (dummy)');
})->name('registrasi.store');


// ================= DASHBOARD (TANPA AUTH) =================
Route::get('/pasien', [PasienController::class, 'index']);

Route::get('/dashboard_pasien', [DashboardPasienController::class, 'index']);

Route::get('/dashboard/admin', [DashboardAdminController::class, 'index']);

Route::get('/dashboard/dokter', [DashboardDokterController::class, 'index']);