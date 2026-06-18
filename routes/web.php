<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\Pasien\DashboardPasienController;
use App\Http\Controllers\Pasien\PemesananJadwalController;
use App\Http\Controllers\Pasien\RiwayatMedisController;
use App\Http\Controllers\Pasien\ProfilPasienController;
use App\Http\Controllers\Dokter\DashboardDokterController;
use App\Http\Controllers\Dokter\JadwalDokterController;
use App\Http\Controllers\Dokter\AntrianPasienController;
use App\Http\Controllers\Dokter\ProfilDokterController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\DataDokterController;
use App\Http\Controllers\Admin\DataPasienController;
use App\Http\Controllers\Admin\DataJadwalController;
use App\Http\Controllers\Admin\ProfilAdminController;

Route::get('/', [HomepageController::class, 'index'])->name('home');

Route::prefix('pages')->group(function () {
    Route::view('/layanan', 'pages.layanan')->name('layanan');
    Route::view('/about', 'pages.about')->name('about');
    Route::view('/contact', 'pages.contact')->name('contact');
});

Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.process');
    Route::get('/registrasi', [RegistrasiController::class, 'index'])->name('registrasi');
    Route::post('/registrasi', [RegistrasiController::class, 'store'])->name('registrasi.store');
    Route::get('/forgot-password', [LoginController::class, 'forgotForm'])->name('forgot.password');
    Route::post('/forgot-password', [LoginController::class, 'sendResetLink'])->name('forgot.process');
    Route::get('/reset-password/{token}', [LoginController::class, 'showResetForm'])->name('reset.form');
    Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('reset.password');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('dashboard')->middleware('auth.session')->group(function () {

    Route::prefix('pasien')->middleware('role:pasien')->group(function () {
        Route::get('/', [DashboardPasienController::class, 'index'])->name('dashboard.pasien');
        Route::get('/pemesanan-jadwal', [PemesananJadwalController::class, 'index'])->name('pemesanan.jadwal');
        Route::post('/pemesanan-jadwal', [PemesananJadwalController::class, 'proses'])->name('pemesanan.proses');
        Route::get('/pemesanan-berhasil/{booking}', [PemesananJadwalController::class, 'berhasil'])->name('pemesanan.berhasil');
        Route::post('/pemesanan-batal/{booking}', [PemesananJadwalController::class, 'batal'])->name('pemesanan.batal');
        Route::get('/profil', [ProfilPasienController::class, 'index'])->name('pasien.profil');
        Route::post('/profil', [ProfilPasienController::class, 'update'])->name('pasien.profil.update');
        Route::get('/riwayat-medis', [RiwayatMedisController::class, 'index'])->name('riwayat.medis');
        Route::get('/riwayat-medis/download-pdf/{id}', [RiwayatMedisController::class, 'downloadPdf'])->name('riwayat.download-pdf');
    });

    Route::prefix('dokter')->middleware('role:dokter')->group(function () {
        Route::get('/', [DashboardDokterController::class, 'index'])->name('dashboard.dokter');
        Route::get('/jadwal', [JadwalDokterController::class, 'index'])->name('dokter.jadwal');
        Route::get('/antrian', [AntrianPasienController::class, 'index'])->name('dokter.antrian');

        Route::post('/antrian/simpan-rekam-medis', [AntrianPasienController::class, 'simpanRekamMedis'])
            ->name('dokter.rekammedis.simpan');

        Route::get('/profil', [ProfilDokterController::class, 'index'])->name('dokter.profil');
    });

    Route::prefix('admin')->middleware('role:admin')->group(function () {

        Route::get('/', [DashboardAdminController::class, 'index'])->name('dashboard.admin');

        // PROFIL ADMIN
        Route::get('/profil', [ProfilAdminController::class, 'index'])->name('admin.profil');
        Route::post('/profil', [ProfilAdminController::class, 'update'])->name('admin.profil.update');

        // DATA DOKTER
        Route::get('/data_dokter', [DataDokterController::class, 'index'])->name('data.dokter');
        Route::post('/data_dokter', [DataDokterController::class, 'store'])->name('data.dokter.store');
        Route::put('/data_dokter/{dokter}', [DataDokterController::class, 'update'])->name('data.dokter.update');

        // DATA PASIEN
        Route::get('/data_pasien', [DataPasienController::class, 'index'])->name('data.pasien');
        Route::post('/data_pasien', [DataPasienController::class, 'store'])->name('data.pasien.store');
        Route::put('/data_pasien/{id}', [DataPasienController::class, 'update'])->name('data.pasien.update');

        // DATA JADWAL
        Route::get('/data_jadwal', [DataJadwalController::class, 'index'])->name('data.jadwal');
        Route::post('/data_jadwal', [DataJadwalController::class, 'store'])->name('data.jadwal.store');
        Route::put('/data_jadwal/{id}', [DataJadwalController::class, 'update'])->name('data.jadwal.update');

    });
});