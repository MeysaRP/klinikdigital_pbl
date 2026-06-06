<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\PemesananJadwal;
use App\Models\User;

class DashboardPasienController extends Controller
{
    public function index()
    {
        $email = session('email');
        $user = User::where('email', $email)->first();

        $filterStatus = request()->get('status', 'all');

        $query = PemesananJadwal::with(['dokter', 'jadwal', 'antrian.rekamMedis'])
            ->where('email', $email);

        if ($filterStatus !== 'all') {
            $query->where('status', $filterStatus);
        }

        // === YANG DIUBAH: Urutkan terdekat di atas ===
        // 1. Jadwal hari ini & ke depan (prioritas 0), yang lalu (prioritas 1)
        // 2. Di dalam "ke depan": tanggal terkecil duluan (terdekat)
        // 3. Di dalam "yang lalu": tanggal terbesar duluan (yang baru saja lewat)
        // 4. Terakhir urutkan jam_mulai
        $bookings = $query
            ->orderByRaw("CASE WHEN tanggal >= CURDATE() THEN 0 ELSE 1 END")
            ->orderByRaw("CASE WHEN tanggal >= CURDATE() THEN tanggal END ASC")
            ->orderByRaw("CASE WHEN tanggal < CURDATE() THEN tanggal END DESC")
            ->orderBy('jam_mulai')
            ->get();
        // ================================================

        $nextBooking = PemesananJadwal::with(['dokter', 'jadwal', 'antrian.rekamMedis'])
            ->where('email', $email)
            ->where('status', 'Menunggu')
            ->whereDate('tanggal', '>=', today())
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->first();

        $initials = 'PS';
        if ($user && $user->name) {
            $words = explode(' ', trim($user->name));
            $initials = strtoupper(substr($words[0], 0, 1));
            if (count($words) > 1) {
                $initials .= strtoupper(substr($words[1], 0, 1));
            }
        }

        return view('pages.pasien.dashboard_pasien', [
            'userName' => $user?->name ?? 'Pasien',
            'userInitial' => $initials,
            'userRole' => 'Pasien',
            'profil' => $user,
            'nextBooking' => $nextBooking,
            'jadwal' => $bookings,
            'statusAktif' => $filterStatus,
        ]);
    }
}
