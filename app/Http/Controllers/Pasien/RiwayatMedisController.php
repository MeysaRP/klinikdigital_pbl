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

        $statusAktif = request('status', 'all');

        $query = PemesananJadwal::with([
            'dokter',
            'jadwal',
            'antrian.rekamMedis'
        ])->where('email', $email);

        if ($statusAktif !== 'all') {
            $query->where('status', $statusAktif);
        }

        $riwayat = $query->orderByDesc('tanggal')->get();

        return view('pages.pasien.riwayat_medis', [
            'userName'    => $user?->nama ?? $user?->name ?? 'Pasien',
            'userRole'    => 'Pasien',
            'userInitial' => $user ? strtoupper(substr($user->nama ?? $user->name, 0, 2)) : 'PS',
            'riwayat'     => $riwayat,
            'statusAktif' => $statusAktif,
        ]);
    }

    private function toSafeString($value, $default = '-')
    {
        if (is_array($value)) {
            $flat = [];
            array_walk_recursive($value, function ($item) use (&$flat) {
                if (!is_array($item)) {
                    $flat[] = $item;
                }
            });
            return count($flat) > 0 ? implode(', ', $flat) : $default;
        }

        if (is_object($value)) {
            return json_encode((array) $value, JSON_UNESCAPED_UNICODE);
        }

        return $value ?? $default;
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
            'poli'      => 'Umum',
            'pasien'    => $booking->nama_pasien ?? $booking->email,
            'gejala'    => $this->toSafeString($booking->keluhan),
            'diagnosa'  => $this->toSafeString($rekam->diagnosa),
            'catatan'   => $this->toSafeString($rekam->catatan_dokter),
            'resep'     => $this->toSafeString($rekam->resep_obat),
            'resep_raw' => $rekam->resep_obat,
        ];

        return Pdf::loadView('pages.pasien.pdf_riwayat', compact('data'))
            ->download('rekam-medis-' . $booking->id . '.pdf');
    }
}