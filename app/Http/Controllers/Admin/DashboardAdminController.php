<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\Antrian;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $totalDokter = Dokter::count();

        $totalPasien = User::where('role', 'pasien')->count();

        $totalJadwal = Jadwal::count();

        $antrians = Antrian::with(['pemesanan.dokter'])
            ->latest()
            ->take(10)
            ->get();

        return view('pages.admin.dashboard_admin', compact(
            'totalDokter',
            'totalPasien',
            'totalJadwal',
            'antrians'
        ));
    }
}