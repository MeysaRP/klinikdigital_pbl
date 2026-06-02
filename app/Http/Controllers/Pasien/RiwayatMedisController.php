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
        $tahunAktif = request()->get('tahun', 'all');
        $statusAktif = request()->get('status', 'all');

        $query = PemesananJadwal::with(['dokter', 'jadwal', 'antrian.rekamMedis'])
            ->where('email', $email);

        if ($statusAktif !== 'all') {
            $query->where('status', $statusAktif);
        }

        $riwayat = $query->orderByDesc('tanggal')->get()->map(function ($booking) {
            $rekam = $booking->antrian?->rekamMedis;
            return [
                'id' => $booking->id,
                'tanggal' => $booking->tanggal,
                'dokter' => $booking->dokter?->nama ?? '-',
                'poli' => 'Umum',
                'status' => $booking->status,
                'gejala' => $booking->keluhan ?? '-',
                'diagnosa' => $rekam?->diagnosa ?? ($booking->status === 'Selesai' ? 'Menunggu diagnosa' : '-'),
                'resep' => $rekam?->catatan_dokter ?? '-',
            ];
        })->toArray();

        if ($tahunAktif !== 'all') {
            $riwayat = array_filter($riwayat, function ($item) use ($tahunAktif) {
                return date('Y', strtotime($item['tanggal'])) == $tahunAktif;
            });
        }

        return view('pages.pasien.riwayat_medis', [
            'userName' => $user?->name ?? 'Pasien',
            'userRole' => 'Pasien',
            'userInitial' => $user ? substr($user->name, 0, 2) : 'PS',
            'riwayat' => array_values($riwayat),
            'tahunAktif' => $tahunAktif,
            'statusAktif' => $statusAktif,
        ]);
    }

    public function downloadPdf($id)
    {
        $email = session('email');

        $booking = PemesananJadwal::with(['dokter', 'jadwal', 'antrian.rekamMedis'])
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
            'dokter' => $booking->dokter?->nama ?? '-',
            'tanggal' => $booking->tanggal,
            'poli' => 'Umum',
            'pasien' => $booking->nama_pasien ?? $booking->email,
            'gejala' => $booking->keluhan ?? '-',
            'diagnosa' => $rekam->diagnosa ?? '-',
            'resep' => $rekam->catatan_dokter ?? '-',
        ];

        return Pdf::loadView('pages.pasien.pdf_riwayat', ['data' => $data])->download('rekam-medis-' . $booking->id . '.pdf');
    }
}