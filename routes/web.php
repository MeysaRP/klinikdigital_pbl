<?php

use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf; // <--- DITAMBAHKAN UNTUK PDF
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardDokterController;
use App\Http\Controllers\DataDokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\JadwalController;

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

        return redirect()->route('pemesanan.berhasil', [
            'nomor_antrian' => sprintf("%02d", $nomor_acak)
        ]);
    })->name('pemesanan.proses');

    Route::get('/pasien/pemesanan-berhasil/{nomor_antrian}', function ($nomor_antrian) {
        return view('pages.pasien.pemesanan_berhasil', compact('nomor_antrian'));
    })->name('pemesanan.berhasil');

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

        return redirect()->route('pasien.profil')
            ->with('success', 'Profil berhasil diperbarui!');

    })->name('pasien.profil.update');

    // ================= RIWAYAT MEDIS =================
    Route::get('/riwayat-medis', function () {
        // 1. Ambil nilai filter dari URL
        $tahunAktif = request()->get('tahun', 'all');
        $statusAktif = request()->get('status', 'all');

        // 2. Data Dummy Lengkap (Sesuai kebutuhan View)
        $semuaRiwayat = [
            [
                'id' => 1,
                'tanggal' => '2024-05-20',
                'dokter' => 'Dr. Ani Lestari',
                'poli' => 'Paru',
                'status' => 'Selesai',
                'gejala' => 'Batuk kering yang tidak kunjung sembuh disertai sesak ringan.',
                'diagnosa' => 'ISPA (Infeksi Saluran Pernapasan Akut)',
                'resep' => 'Ambroxol 3x1, Paracetamol 3x1, Vitamin C 1x1'
            ],
            [
                'id' => 2,
                'tanggal' => '2024-01-15',
                'dokter' => 'Dr. Budi Hartono',
                'poli' => 'Penyakit Dalam',
                'status' => 'Selesai',
                'gejala' => 'Sakit ulu hati dan mual setelah makan pedas.',
                'diagnosa' => 'Gastritis Akut',
                'resep' => 'Omeprazole 1x1, Antasida 3x1'
            ],
            [
                'id' => 3,
                'tanggal' => '2023-11-10',
                'dokter' => 'Dr. Sarah Wijaya',
                'poli' => 'Umum',
                'status' => 'Dibatalkan',
                'gejala' => 'Pusing kepala dan demam ringan.',
                'diagnosa' => '-',
                'resep' => '-'
            ],
            [
                'id' => 4,
                'tanggal' => '2023-08-05',
                'dokter' => 'Dr. Andi Saputra',
                'poli' => 'Gigi',
                'status' => 'Selesai',
                'gejala' => 'Sakit gigi geraham bawah kanan.',
                'diagnosa' => 'Karies Gigi',
                'resep' => 'Amoxicillin 3x1, Ibuprofen 3x1 (bila sakit)'
            ],
        ];

        // 3. Logika Filter
        $riwayatTerfilter = $semuaRiwayat;

        if ($tahunAktif !== 'all') {
            $riwayatTerfilter = array_filter($riwayatTerfilter, function ($item) use ($tahunAktif) {
                return date('Y', strtotime($item['tanggal'])) == $tahunAktif;
            });
        }

        if ($statusAktif !== 'all') {
            $riwayatTerfilter = array_filter($riwayatTerfilter, function ($item) use ($statusAktif) {
                return $item['status'] == $statusAktif;
            });
        }

        // Reset index array setelah filter
        $riwayatTerfilter = array_values($riwayatTerfilter);

        // 4. Return View
        return view('pages.pasien.riwayat_medis', [
            'riwayat' => $riwayatTerfilter,
            'tahunAktif' => $tahunAktif,
            'statusAktif' => $statusAktif
        ]);
    })->name('riwayat.medis');

    // ================= ROUTE EXPORT PDF (ASLI) =================
    Route::get('/riwayat-medis/download-pdf/{id}', function ($id) {
        // 1. Ambil Data (Sama dengan data di atas)
        $semuaRiwayat = [
            ['id' => 1, 'tanggal' => '2024-05-20', 'dokter' => 'Dr. Ani Lestari', 'poli' => 'Paru', 'status' => 'Selesai', 'gejala' => 'Batuk kering yang tidak kunjung sembuh disertai sesak ringan.', 'diagnosa' => 'ISPA (Infeksi Saluran Pernapasan Akut)', 'resep' => 'Ambroxol 3x1, Paracetamol 3x1, Vitamin C 1x1'],
            ['id' => 2, 'tanggal' => '2024-01-15', 'dokter' => 'Dr. Budi Hartono', 'poli' => 'Penyakit Dalam', 'status' => 'Selesai', 'gejala' => 'Sakit ulu hati dan mual setelah makan pedas.', 'diagnosa' => 'Gastritis Akut', 'resep' => 'Omeprazole 1x1, Antasida 3x1'],
            ['id' => 3, 'tanggal' => '2023-11-10', 'dokter' => 'Dr. Sarah Wijaya', 'poli' => 'Umum', 'status' => 'Dibatalkan', 'gejala' => 'Pusing kepala dan demam ringan.', 'diagnosa' => '-', 'resep' => '-'],
            ['id' => 4, 'tanggal' => '2023-08-05', 'dokter' => 'Dr. Andi Saputra', 'poli' => 'Gigi', 'status' => 'Selesai', 'gejala' => 'Sakit gigi geraham bawah kanan.', 'diagnosa' => 'Karies Gigi', 'resep' => 'Amoxicillin 3x1, Ibuprofen 3x1 (bila sakit)'],
        ];

        // 2. Cari item berdasarkan ID
        $item = collect($semuaRiwayat)->firstWhere('id', $id);

        if (!$item) {
            return abort(404, 'Data tidak ditemukan');
        }

        // 3. Load View PDF
        // Pastikan file ada di: resources/views/pdf/riwayat_medis.blade.php
        // KODE BARU
        $pdf = Pdf::loadView('pages.pasien.pdf_riwayat', ['data' => $item]);

        // 4. Download PDF
        return $pdf->download('rekam-medis-' . $item['id'] . '.pdf');
    })->name('riwayat.download-pdf');


    // ================= DOKTER =================
    Route::get('/dokter', [DashboardDokterController::class, 'index'])->name('dashboard.dokter');

    Route::get('/dokter/jadwal', function () {
        return view('pages.dokter.jadwal_saya');
    })->name('dokter.jadwal');

    Route::get('/dokter/antrian', function () {
        return view('pages.dokter.antrian_pasien');
    })->name('dokter.antrian');

    Route::get('/dokter/profil', function () {
        return view('pages.dokter.profil');
    })->name('dokter.profil');


    // ================= ADMIN =================
    Route::get('/admin', [DashboardAdminController::class, 'index'])->name('dashboard.admin');

    // DATA DOKTER
    Route::get('/data_dokter', [DataDokterController::class, 'index'])->name('data.dokter');
    Route::post('/data_dokter', [DataDokterController::class, 'store'])->name('data.dokter.store');
    Route::put('/data_dokter/{dokter}', [DataDokterController::class, 'update'])->name('data.dokter.update');

    // DATA PASIEN
    Route::get('/data_pasien', [PasienController::class, 'index'])->name('data.pasien');

    // DATA JADWAL
    Route::get('/data_jadwal', [JadwalController::class, 'index'])->name('data.jadwal');
    Route::post('/data_jadwal', [JadwalController::class, 'store'])->name('data.jadwal.store');
    Route::put('/data_jadwal/{id}', [JadwalController::class, 'update'])->name('data.jadwal.update');

});