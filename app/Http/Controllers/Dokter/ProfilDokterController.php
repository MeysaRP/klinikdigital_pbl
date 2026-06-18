<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\PemesananJadwal;

class ProfilDokterController extends Controller
{
    public function index()
    {
        $dokterId = session('id');

        $dokter = Dokter::find($dokterId);

        if (!$dokter) {
            return redirect()->route('login')
                ->with('error', 'Data dokter tidak ditemukan.');
        }

        // Hitung jumlah pasien unik yang pernah melakukan pemesanan
        $totalPasien = PemesananJadwal::where('dokter_id', $dokterId)
            ->whereDate('tanggal', today())
            ->count();

        return view('pages.dokter.profil', [
            'dokter' => $dokter,
            'totalPasien' => $totalPasien,
            'userName' => $dokter->nama,
            'userRole' => 'Dokter',
            'userInitial' => strtoupper(substr($dokter->nama, 0, 2)),
        ]);
    }
}