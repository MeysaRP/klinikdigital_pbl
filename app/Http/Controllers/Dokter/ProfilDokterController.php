<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\PemesananJadwal;

class ProfilDokterController extends Controller
{
    // Fungsi untuk menampilkan profil dokter
    public function index()
    {
        // Ambil ID dokter dari session
        $dokterId = session('id');

        // Ambil data dokter berdasarkan ID
        $dokter = Dokter::find($dokterId);

        // Jika dokter tidak ditemukan, redirect ke halaman login dengan pesan error
        if (!$dokter) {
            return redirect()->route('login')
                ->with('error', 'Data dokter tidak ditemukan.');
        }

        // Hitung jumlah pasien unik yang pernah melakukan pemesanan
        $totalPasien = PemesananJadwal::where('dokter_id', $dokterId)
            ->whereDate('tanggal', today())
            ->count();
            
        // Kirim data ke view
        return view('pages.dokter.profil', [
            'dokter' => $dokter,
            'totalPasien' => $totalPasien,
            'userName' => $dokter->nama,
            'userRole' => 'Dokter',
            'userInitial' => strtoupper(substr($dokter->nama, 0, 2)),
        ]);
    }
}