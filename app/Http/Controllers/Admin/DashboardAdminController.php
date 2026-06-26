<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\Antrian;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardAdminController extends Controller
{
    public function index(Request $request)
{
    $totalDokter = Dokter::count();
    $totalPasien = User::where('role', 'pasien')->count();
    $totalJadwal = Jadwal::count();

    // filter tanggal (default hari ini)
    $tanggal = $request->filled('tanggal')
        ? $request->tanggal
        : Carbon::today()->toDateString();

    $dokterId = $request->dokter_id;

    $antrians = Antrian::with(['pemesanan.dokter'])
        ->whereDate('created_at', $tanggal)
        ->when($dokterId, function ($query) use ($dokterId) {
            $query->whereHas('pemesanan', function ($q) use ($dokterId) {
                $q->where('dokter_id', $dokterId);
            });
        })
        ->latest()
        ->paginate(10) 
        ->withQueryString(); // supaya filter tidak hilang saat pindah halaman

    $dokters = Dokter::orderBy('nama')->get();

    return view('pages.admin.dashboard_admin', compact(
        'totalDokter',
        'totalPasien',
        'totalJadwal',
        'antrians',
        'dokters',
        'tanggal',
        'dokterId'
    ));
}
}