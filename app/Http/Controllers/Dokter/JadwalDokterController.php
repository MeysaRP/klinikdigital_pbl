<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\PemesananJadwal;
use App\Models\Dokter; 

class JadwalDokterController extends Controller
{
    public function index()
    {

        $dokter = Dokter::where('email', session('email'))->first();
        $dokterId = $dokter ? $dokter->id : 0;

        if (! $dokterId || session('role') !== 'dokter') {
            return redirect()->route('login')->with('error', 'Sesi habis atau akses ditolak. Silakan login ulang.');
        }

        $jadwals = Jadwal::withCount('pemesanan')
            ->where('dokter_id', $dokterId) 
            ->orderByRaw("FIELD(hari,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')")
            ->orderBy('jam_mulai')
            ->get();

        $aktifCount = $jadwals->where('status', 'Aktif')->count();
        $cutiCount = $jadwals->where('status', 'Cuti')->count();
        $cutiDays = $jadwals->where('status', 'Cuti')->pluck('hari')->unique()->implode(', ');
        
        $pasienHariIni = PemesananJadwal::where('dokter_id', $dokterId) 
            ->where('tanggal', now()->format('Y-m-d'))
            ->count();

        return view('pages.dokter.jadwal_saya', [
            'jadwals' => $jadwals,
            'aktifCount' => $aktifCount,
            'cutiCount' => $cutiCount,
            'cutiDays' => $cutiDays,
            'pasienHariIni' => $pasienHariIni,
        ]);
    }
}