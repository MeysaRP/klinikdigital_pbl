<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\Jadwal;

class DashboardDokterController extends Controller
{
    // Fungsi untuk menampilkan dashboard dokter
    public function index()
    {
        // Ambil data dokter berdasarkan email dari session
        $dokter = Dokter::where('email', session('email'))->first();
        $dokterId = $dokter ? $dokter->id : 0; 

        $today = now()->format('Y-m-d');

        // Mapping hari 
        $hariMap = [
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
            'Sunday'    => 'Minggu',
        ];

        // Ambil nama hari 
        $hariIni = $hariMap[now()->format('l')] ?? now()->format('l');

        // Ambil kuota dari jadwal hari ini
        $jadwalHariIni = Jadwal::where('dokter_id', $dokterId)
            ->where('hari', $hariIni)
            ->where('status', 'Aktif')
            ->first();

        // Jika tidak ada jadwal, set kuota menjadi 0
        $kuotaHariIni = $jadwalHariIni ? $jadwalHariIni->kuota_pasien : 0;

        // Hitung jumlah pasien menunggu dan selesai hari ini
        $menungguCount = Antrian::whereHas('pemesanan', function($query) use ($dokterId, $today) {
            $query->where('dokter_id', $dokterId)->whereDate('tanggal', $today);
        })->where('status', 'menunggu')->count();

        // Hitung jumlah pasien selesai hari ini
        $selesaiCount = Antrian::whereHas('pemesanan', function($query) use ($dokterId, $today) {
            $query->where('dokter_id', $dokterId)->whereDate('tanggal', $today);
        })->where('status', 'selesai')->count();

        // Ambil data antrian pasien
        $antrianSelanjutnya = Antrian::whereHas('pemesanan', function($query) use ($dokterId, $today) {
            $query->where('dokter_id', $dokterId)->whereDate('tanggal', $today);
        })->where('status', 'menunggu')
          ->orderBy('nomor_antrian', 'asc')
          ->first();

        //  Hitung persen berdasarkan KUOTA
        $persen = ($kuotaHariIni > 0) ? round(($selesaiCount / $kuotaHariIni) * 100) : 0;

        // Kirim data ke view
        return view('pages.dokter.dashboard_dokter', compact(
            'menungguCount', 
            'selesaiCount', 
            'antrianSelanjutnya', 
            'persen',
            'kuotaHariIni'  
        ));
    }
}