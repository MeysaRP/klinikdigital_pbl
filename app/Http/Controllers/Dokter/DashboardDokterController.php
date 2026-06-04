<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Antrian;

class DashboardDokterController extends Controller
{
    public function index()
    {
        $dokterId = session('id');
        $today = now()->format('Y-m-d');

        $menungguCount = Antrian::whereHas('pemesanan', function($query) use ($dokterId, $today) {
            $query->where('dokter_id', $dokterId)->where('tanggal', $today);
        })->where('status', 'menunggu')->count();

        $selesaiCount = Antrian::whereHas('pemesanan', function($query) use ($dokterId, $today) {
            $query->where('dokter_id', $dokterId)->where('tanggal', $today);
        })->where('status', 'selesai')->count();

        $antrianSelanjutnya = Antrian::whereHas('pemesanan', function($query) use ($dokterId, $today) {
            $query->where('dokter_id', $dokterId)->where('tanggal', $today);
        })->where('status', 'menunggu')
          ->orderBy('nomor_antrian', 'asc')
          ->first();

        $totalHariIni = $menungguCount + $selesaiCount;
        $persen = ($totalHariIni > 0) ? round(($selesaiCount / $totalHariIni) * 100) : 0;

        return view('pages.dokter.dashboard_dokter', compact('menungguCount', 'selesaiCount', 'antrianSelanjutnya', 'persen'));
    }
}