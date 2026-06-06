<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\PemesananJadwal;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class RiwayatMedisController extends Controller
{
    public function index()
    {
        $email = session('email');

        $user = User::where('email', $email)->first();

        $tahunAktif = request('tahun', 'all');
        $statusAktif = request('status', 'all');

        $query = PemesananJadwal::with([
            'dokter',
            'jadwal',
            'antrian.rekamMedis'
        ])->where('email', $email);

        if ($statusAktif !== 'all') {
            $query->where('status', $statusAktif);
        }

        if ($tahunAktif !== 'all') {
            $query->whereYear('tanggal', $tahunAktif);
        }

        $riwayat = $query->orderByDesc('tanggal')->get();

        return view('pages.pasien.riwayat_medis', [
            'userName'    => $user?->nama ?? $user?->name ?? 'Pasien',
            'userRole'    => 'Pasien',
            'userInitial' => $user ? strtoupper(substr($user->nama ?? $user->name, 0, 2)) : 'PS',
            'riwayat'     => $riwayat,
            'tahunAktif'  => $tahunAktif,
            'statusAktif' => $statusAktif,
        ]);
    }

    public function downloadPdf($id)
    {
        $email = session('email');

        $booking = PemesananJadwal::with([
                'dokter',
                'jadwal',
                'antrian.rekamMedis'
            ])
            ->where('email', $email)
            ->where('id', $id)
            ->firstOrFail();

        if ($booking->status !== 'Selesai') {
            abort(404);
        }

        $rekam = $booking->antrian?->rekamMedis;

        if (!$rekam) {
            abort(404);
        }

        $data = [
            'dokter'    => $booking->dokter?->nama ?? '-',
            'tanggal'   => $booking->tanggal,
            'poli'      => $booking->jadwal?->poli ?? 'Umum',
            'pasien'    => $booking->nama_pasien ?? $booking->email,
            'gejala'    => $booking->keluhan ?? '-',
            'diagnosa'  => $rekam->diagnosa ?? '-',
            'resep'     => $rekam->catatan_dokter ?? '-',
        ];

        return Pdf::loadView('pages.pasien.pdf_riwayat', compact('data'))
            ->download('rekam-medis-' . $booking->id . '.pdf');
    }
}