<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardDokterController;
use App\Http\Controllers\DataDokterController;

// ================= HALAMAN PUBLIK =================
Route::get('/', [HomepageController::class, 'index'])->name('home');

// ================= AUTH =================
Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.process');

    Route::get('/registrasi', [RegistrasiController::class, 'index'])->name('registrasi');
    Route::post('/registrasi', [RegistrasiController::class, 'store'])->name('registrasi.store');

    Route::get('/forgot-password', [LoginController::class, 'forgotForm'])->name('forgot.password');
    Route::post('/forgot-password', [LoginController::class, 'resetPassword'])->name('forgot.process');
});

// ================= LOGOUT =================
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ================= DASHBOARD =================
Route::prefix('dashboard')->group(function () {

    // ================= DASHBOARD PASIEN =================
    Route::get('/pasien', function () {
        $filterStatus = request()->get('status', 'all');

        $semuaJadwal = [
            ['id' => 1, 'dokter' => 'Dr. Sarah Wijaya', 'tanggal' => '2025-05-22', 'jam' => '08:00 - 08:30 WIB', 'status' => 'Menunggu', 'keluhan' => 'Demam tinggi dan sesak napas'],
            ['id' => 2, 'dokter' => 'Dr. Budi Hartono', 'tanggal' => '2024-01-15', 'jam' => '14:00 - 14:30 WIB', 'status' => 'Selesai', 'keluhan' => 'Gastritis Akut'],
            ['id' => 3, 'dokter' => 'Dr. Ani Lestari', 'tanggal' => '2024-05-20', 'jam' => '09:00 - 09:30 WIB', 'status' => 'Selesai', 'keluhan' => 'ISPA'],
        ];

        $jadwalTerfilter = $semuaJadwal;
        if ($filterStatus !== 'all') {
            $jadwalTerfilter = array_filter($jadwalTerfilter, function ($item) use ($filterStatus) {
                return $item['status'] == $filterStatus;
            });
        }

        return view('pages.pasien.dashboard_pasien', [
            'jadwal' => $jadwalTerfilter,
            'statusAktif' => $filterStatus
        ]);
    })->name('dashboard.pasien');

    // ================= DASHBOARD LAIN =================
    Route::get('/dokter', [DashboardDokterController::class, 'index'])->name('dashboard.dokter');
    Route::get('/admin', [DashboardAdminController::class, 'index'])->name('dashboard.admin');

    // ================= DATA MASTER =================
    Route::get('/data_dokter', [DataDokterController::class, 'index'])->name('data.dokter');
    Route::get('/data_pasien', [DashboardAdminController::class, 'dataPasien'])->name('data.pasien');

    //  DATA JADWAL
    Route::get('/data_jadwal', [DashboardAdminController::class, 'dataJadwal'])->name('data.jadwal');

    // ================= PEMESANAN =================
    Route::get('/pasien/pemesanan-jadwal', function () {
        return view('pages.pasien.pemesanan_jadwal');
    })->name('pemesanan.jadwal');

    Route::post('/pasien/pemesanan-jadwal', function () {
        $nomor_acak = rand(1, 99);
        return redirect()->route('pemesanan.berhasil', [
            'nomor_antrian' => sprintf("%02d", $nomor_acak)
        ]);
    })->name('pemesanan.proses');

    Route::get('/pasien/pemesanan-berhasil/{nomor_antrian}', function ($nomor_antrian) {
        return view('pages.pasien.pemesanan_berhasil', compact('nomor_antrian'));
    })->name('pemesanan.berhasil');

    // ================= RIWAYAT MEDIS =================
    Route::get('/pasien/riwayat-medis', function () {
        $filterTahun = request()->get('tahun', 'all');
        $filterStatus = request()->get('status', 'all');

        $semuaRiwayat = [
            ['id' => 1, 'tanggal' => '2025-05-22', 'dokter' => 'Dr. Budi Hartono', 'poli' => 'Penyakit Dalam', 'status' => 'Selesai', 'gejala' => 'Demam tinggi selama 3 hari', 'diagnosa' => 'ISPA', 'resep' => 'Paracetamol'],
        ];

        $dataTerfilter = $semuaRiwayat;

        return view('pages.pasien.riwayat_medis', [
            'riwayat' => $dataTerfilter,
            'tahunAktif' => $filterTahun,
            'statusAktif' => $filterStatus
        ]);
    })->name('riwayat.medis');

    // ================= PROFIL =================
    Route::get('/pasien/profil', function () {
        return view('pages.pasien.profil');
    })->name('pasien.profil');

});