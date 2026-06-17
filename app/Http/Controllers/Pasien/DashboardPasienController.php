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

        // Query untuk mendapatkan semua pemesanan jadwal pasien dengan filter status
        $query = PemesananJadwal::with(['dokter', 'jadwal', 'antrian.rekamMedis'])
            ->where('email', $email);

        // Terapkan filter status jika tidak 'all'
        if ($filterStatus !== 'all') {
            $query->where('status', $filterStatus);
        }

        // Urutkan: Menunggu duluan (terdekat), lalu Selesai/Dibatalkan (terbaru)
        $bookings = $query
            ->orderByRaw("CASE WHEN status = 'Menunggu' THEN 0 ELSE 1 END")
            ->orderByRaw("CASE WHEN status = 'Menunggu' THEN tanggal END ASC")
            ->orderByRaw("CASE WHEN status = 'Menunggu' THEN jam_mulai END ASC")
            ->orderByRaw("CASE WHEN status != 'Menunggu' THEN tanggal END DESC")
            ->orderByRaw("CASE WHEN status != 'Menunggu' THEN jam_mulai END DESC")
            ->get();

        // Dapatkan booking berikutnya yang berstatus Menunggu dan tanggalnya hari ini atau setelahnya
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

        $userKategori = $user?->kategori;
        if ($userKategori === 'Staff TU') {
            $userKategori = 'Tenaga Kependidikan';
        }

        return view('pages.pasien.dashboard_pasien', [
            'userName' => $user?->name ?? 'Pasien',
            'userInitial' => $initials,
            'userRole' => 'Pasien',
            'profil' => $user,
            'userKategori' => $userKategori ?? '-',
            'nextBooking' => $nextBooking,
            'jadwal' => $bookings,
            'statusAktif' => $filterStatus,
        ]);
    }
}
