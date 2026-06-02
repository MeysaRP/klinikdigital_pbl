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

        $bookings = $query->orderByDesc('tanggal')->orderByDesc('jam_mulai')->get();

        $nextBooking = PemesananJadwal::with(['dokter', 'jadwal', 'antrian.rekamMedis'])
            ->where('email', $email)
            ->where('status', 'Menunggu')
            ->whereDate('tanggal', '>=', today())
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->first();

        // Hitung inisial dengan benar
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
