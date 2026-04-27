<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardDokterController;
use App\Http\Controllers\DataDokterController;

/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK
|--------------------------------------------------------------------------
*/
Route::get('/', [HomepageController::class, 'index'])->name('home');

Route::prefix('pages')->group(function () {
    Route::view('/layanan', 'pages.layanan')->name('layanan');
    Route::view('/about', 'pages.about')->name('about');
    Route::view('/contact', 'pages.contact')->name('contact');
});

/*
|--------------------------------------------------------------------------
| AUTH (Login, Registrasi, Logout, Forgot Password)
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.process');

    Route::get('/registrasi', [RegistrasiController::class, 'index'])->name('registrasi');
    Route::post('/registrasi', [RegistrasiController::class, 'store'])->name('registrasi.store');

    Route::get('/forgot-password', [LoginController::class, 'forgotForm'])->name('forgot.password');
    Route::post('/forgot-password', [LoginController::class, 'resetPassword'])->name('forgot.process');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/
Route::prefix('dashboard')->group(function () {

    // ================= PASIEN =================
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

    Route::get('/pasien/pemesanan-jadwal', function () {
        return view('pages.pasien.pemesanan_jadwal');
    })->name('pemesanan.jadwal');

    Route::post('/pasien/pemesanan-jadwal', function () {
        $nomor_acak = rand(1, 99);
        return redirect()->route('pemesanan.berhasil', ['nomor_antrian' => sprintf("%02d", $nomor_acak)]);
    })->name('pemesanan.proses');

    Route::get('/pasien/pemesanan-berhasil/{nomor_antrian}', function ($nomor_antrian) {
        return view('pages.pasien.pemesanan_berhasil', compact('nomor_antrian'));
    })->name('pemesanan.berhasil');

    Route::get('/pasien/riwayat-medis', function () {
        $filterTahun = request()->get('tahun', 'all');
        $filterStatus = request()->get('status', 'all');

        $semuaRiwayat = [
            ['id' => 1, 'tanggal' => '2025-05-22', 'dokter' => 'Dr. Budi Hartono', 'poli' => 'Penyakit Dalam', 'status' => 'Selesai', 'gejala' => 'Demam tinggi selama 3 hari, batuk berdahak, dan nyeri otot.', 'diagnosa' => 'Infeksi Saluran Pernapasan Akut (ISPA)', 'resep' => 'Paracetamol 500mg (3x1), Amoxillin 500mg (3x1), OBH Batuk (3x1)'],
            ['id' => 2, 'tanggal' => '2025-04-10', 'dokter' => 'Dr. Sarah Wijaya', 'poli' => 'Umum', 'status' => 'Selesai', 'gejala' => 'Sakit kepala sebelah kanan yang datang tiba-tiba, sensitif terhadap cahaya.', 'diagnosa' => 'Migraine Tanpa Aura', 'resep' => 'Asam Mefenamat 500mg (3x1), Sumatriptan 50mg (jika sakit parah)'],
            ['id' => 3, 'tanggal' => '2024-11-15', 'dokter' => 'Dr. Ani Lestari', 'poli' => 'Gigi', 'status' => 'Dibatalkan', 'gejala' => 'Sakit gigi geraham bawah kanan saat mengunyah makanan keras.', 'diagnosa' => 'N/A', 'resep' => 'N/A'],
            ['id' => 4, 'tanggal' => '2024-08-05', 'dokter' => 'Dr. Budi Hartono', 'poli' => 'Penyakit Dalam', 'status' => 'Selesai', 'gejala' => 'Nyeri ulu hati terutama setelah makan makanan pedas atau asam.', 'diagnosa' => 'Gastritis Akut (Maag)', 'resep' => 'Omeprazole 20mg (2x1 sebelum makan), Antasida (3x1)'],
            ['id' => 5, 'tanggal' => '2023-06-12', 'dokter' => 'Dr. Sarah Wijaya', 'poli' => 'Umum', 'status' => 'Menunggu', 'gejala' => 'Nyeri sendi lutut kiri saat berjalan jarak jauh.', 'diagnosa' => 'N/A', 'resep' => 'N/A'],
        ];

        $dataTerfilter = $semuaRiwayat;
        if ($filterTahun !== 'all') {
            $dataTerfilter = array_filter($dataTerfilter, function ($item) use ($filterTahun) {
                return date('Y', strtotime($item['tanggal'])) == $filterTahun;
            });
        }
        if ($filterStatus !== 'all') {
            $dataTerfilter = array_filter($dataTerfilter, function ($item) use ($filterStatus) {
                return $item['status'] == $filterStatus;
            });
        }

        return view('pages.pasien.riwayat_medis', [
            'riwayat' => $dataTerfilter,
            'tahunAktif' => $filterTahun,
            'statusAktif' => $filterStatus
        ]);
    })->name('riwayat.medis');

    Route::get('/pasien/riwayat-medis/pdf/{id}', function ($id) {
        $semuaRiwayat = [
            ['id' => 1, 'tanggal' => '2025-05-22', 'dokter' => 'Dr. Budi Hartono', 'poli' => 'Penyakit Dalam', 'status' => 'Selesai', 'gejala' => 'Demam tinggi selama 3 hari, batuk berdahak, dan nyeri otot.', 'diagnosa' => 'Infeksi Saluran Pernapasan Akut (ISPA)', 'resep' => 'Paracetamol 500mg (3x1), Amoxillin 500mg (3x1), OBH Batuk (3x1)'],
            ['id' => 2, 'tanggal' => '2025-04-10', 'dokter' => 'Dr. Sarah Wijaya', 'poli' => 'Umum', 'status' => 'Selesai', 'gejala' => 'Sakit kepala sebelah kanan yang datang tiba-tiba, sensitif terhadap cahaya.', 'diagnosa' => 'Migraine Tanpa Aura', 'resep' => 'Asam Mefenamat 500mg (3x1), Sumatriptan 50mg (jika sakit parah)'],
            ['id' => 3, 'tanggal' => '2024-11-15', 'dokter' => 'Dr. Ani Lestari', 'poli' => 'Gigi', 'status' => 'Dibatalkan', 'gejala' => 'Sakit gigi geraham bawah kanan saat mengunyah makanan keras.', 'diagnosa' => 'N/A', 'resep' => 'N/A'],
            ['id' => 4, 'tanggal' => '2024-08-05', 'dokter' => 'Dr. Budi Hartono', 'poli' => 'Penyakit Dalam', 'status' => 'Selesai', 'gejala' => 'Nyeri ulu hati terutama setelah makan makanan pedas atau asam.', 'diagnosa' => 'Gastritis Akut (Maag)', 'resep' => 'Omeprazole 20mg (2x1 sebelum makan), Antasida (3x1)'],
            ['id' => 5, 'tanggal' => '2023-06-12', 'dokter' => 'Dr. Sarah Wijaya', 'poli' => 'Umum', 'status' => 'Menunggu', 'gejala' => 'Nyeri sendi lutut kiri saat berjalan jarak jauh.', 'diagnosa' => 'N/A', 'resep' => 'N/A'],
        ];
        $dataPdf = collect($semuaRiwayat)->firstWhere('id', $id);
        $pdf = app('dompdf.wrapper')->loadView('pages.pasien.pdf_riwayat', ['data' => $dataPdf]);
        return $pdf->download('Rekam_Medis_' . str_replace(' ', '_', $dataPdf['dokter']) . '.pdf');
    })->name('riwayat.download-pdf');

    Route::get('/pasien/profil', function () {
        $profil = session()->get('profil', [
            'nama' => 'Andi Pratama Rayhan',
            'tgl_lahir' => '2000-11-16',
            'jk' => 'Laki-laki',
            'no_hp' => '082124456789',
            'alamat' => 'Jl. Kestung No.15, Pretanteru'
        ]);
        return view('pages.pasien.profil', compact('profil'));
    })->name('pasien.profil');

    Route::post('/pasien/profil', function () {
        $data = [
            'nama' => request()->nama ?: 'Andi Pratama Rayhan',
            'tgl_lahir' => request()->tgl_lahir ?: '2000-11-16',
            'jk' => request()->jk ?: 'Laki-laki',
            'no_hp' => request()->no_hp ?: '082124456789',
            'alamat' => request()->alamat ?: 'Jl. Kestung No.15, Pretanteru'
        ];
        session()->put('profil', $data);
        return redirect()->route('pasien.profil')->with('success', 'Profil berhasil diperbarui!');
    })->name('pasien.profil.update');

    // ================= DOKTER =================
    Route::get('/dokter', [DashboardDokterController::class, 'index'])->name('dashboard.dokter');
    Route::get('/dokter/jadwal', function () { return view('pages.dokter.jadwal_saya'); })->name('dokter.jadwal');
    Route::get('/dokter/antrian', function () { return view('pages.dokter.antrian_pasien'); })->name('dokter.antrian');
    Route::get('/dokter/profil', function () { return view('pages.dokter.profil'); })->name('dokter.profil');

    // ================= ADMIN =================
    Route::get('/admin', [DashboardAdminController::class, 'index'])->name('dashboard.admin');
    Route::get('/data_dokter', [DataDokterController::class, 'index'])->name('data.dokter');
    Route::get('/data_pasien', [DashboardAdminController::class, 'dataPasien'])->name('data.pasien');
    Route::get('/data_jadwal', [DashboardAdminController::class, 'dataJadwal'])->name('data.jadwal');

});