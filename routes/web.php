<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\DashboardPasienController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardDokterController;

// ================= HALAMAN PUBLIK =================
Route::get('/', [HomepageController::class, 'index'])->name('home');

// ================= AUTH (LOGIN, REGISTER, LUPA) =================
Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', function () {
        return redirect('/dashboard/pasien')->with('success', 'Login berhasil (dummy)');
    })->name('login.process');

    Route::get('/registrasi', [RegistrasiController::class, 'index'])->name('registrasi');
    Route::post('/registrasi', function () {
        return redirect('/auth/login')->with('success', 'Registrasi berhasil (dummy)');
    })->name('registrasi.store');

    Route::get('/forgot-password', [LoginController::class, 'forgotForm'])->name('forgot.password');
    Route::post('/forgot-password', function () {
        return redirect('/auth/login')->with('success', 'Password berhasil diubah (dummy)');
    })->name('forgot.process');
});

// ================= LOGOUT =================
Route::post('/logout', function () {
    return redirect('/auth/login');
})->name('logout');

// ================= DASHBOARD =================
Route::prefix('dashboard')->group(function () {
    Route::get('/pasien', [DashboardPasienController::class, 'index'])->name('dashboard.pasien');
    Route::get('/admin', [DashboardAdminController::class, 'index'])->name('dashboard.admin');
    Route::get('/dokter', [DashboardDokterController::class, 'index'])->name('dashboard.dokter');
});