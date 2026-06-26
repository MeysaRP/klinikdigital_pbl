<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\PemesananJadwal;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

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
            'userInitial' => $this->getInitials($user),
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
            ->first();

        // Cek apakah booking ada dan statusnya sudah Selesai
        if (!$booking || $booking->status !== 'Selesai') {
            return back()->with('popup_error', 'Tidak bisa diunduh karena data belum diisi oleh dokter');
        }

        $rekam = $booking->antrian?->rekamMedis;

        // Cek apakah rekam medisnya sudah diisi dokter
        if (!$rekam) {
            return back()->with('popup_error', 'Tidak bisa diunduh karena data belum diisi oleh dokter');
        }

        // Hitung masa berlaku resep (H+1 dari tanggal pemeriksaan)
        $masaBerlaku = (int) env('RESEP_BERLAKU_HARI', 1);
        $tanggalBerlaku = Carbon::parse($booking->tanggal)->addDays($masaBerlaku);
        $tanggalBerlakuFormatted = $tanggalBerlaku->locale('id')->translatedFormat('d F Y');

        $data = [
            'dokter'          => $booking->dokter?->nama ?? '-',
            'tanggal'         => $booking->tanggal,
            'pasien'          => $booking->nama_pasien ?? $booking->email,
            'gejala'          => $this->toSafeString($booking->keluhan),
            'diagnosa'        => $this->toSafeString($rekam->diagnosa),
            'catatan'         => $this->toSafeString($rekam->catatan_dokter),
            'resep'           => $this->toSafeString($rekam->resep_obat),
            'resep_raw'       => $rekam->resep_obat,
            'tanggal_berlaku' => $tanggalBerlakuFormatted,
        ];

        return Pdf::loadView('pages.pasien.pdf_riwayat', compact('data'))
            ->download('rekam-medis-' . $booking->id . '.pdf');
    }

    private function getInitials($user)
    {
        $initials = 'PS';
        $name = $user->nama ?? $user->name;
        if ($user && $name) {
            $words = explode(' ', trim($name));
            $initials = strtoupper(substr($words[0], 0, 1));
            if (count($words) > 1) {
                $initials .= strtoupper(substr($words[1], 0, 1));
            }
        }
        return $initials;
    }
}