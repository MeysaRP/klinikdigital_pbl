<?php
namespace App\Http\Controllers\Pasien;
use App\Http\Controllers\Controller;

class DashboardPasienController extends Controller
{
    public function index()
    {
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
        return view('pages.pasien.dashboard_pasien', ['jadwal' => $jadwalTerfilter, 'statusAktif' => $filterStatus]);
    }
}