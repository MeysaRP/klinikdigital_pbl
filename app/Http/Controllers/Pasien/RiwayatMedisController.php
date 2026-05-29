<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class RiwayatMedisController extends Controller
{
    public function index()
    {
        $tahunAktif = request()->get('tahun', 'all');
        $statusAktif = request()->get('status', 'all');

        $semuaRiwayat = [
            ['id' => 1, 'tanggal' => '2024-05-20', 'dokter' => 'Dr. Ani Lestari', 'poli' => 'Paru', 'status' => 'Selesai', 'gejala' => 'Batuk kering yang tidak kunjung sembuh disertai sesak ringan.', 'diagnosa' => 'ISPA (Infeksi Saluran Pernapasan Akut)', 'resep' => 'Ambroxol 3x1, Paracetamol 3x1, Vitamin C 1x1'],
            ['id' => 2, 'tanggal' => '2024-01-15', 'dokter' => 'Dr. Budi Hartono', 'poli' => 'Penyakit Dalam', 'status' => 'Selesai', 'gejala' => 'Sakit ulu hati dan mual setelah makan pedas.', 'diagnosa' => 'Gastritis Akut', 'resep' => 'Omeprazole 1x1, Antasida 3x1'],
            ['id' => 3, 'tanggal' => '2023-11-10', 'dokter' => 'Dr. Sarah Wijaya', 'poli' => 'Umum', 'status' => 'Dibatalkan', 'gejala' => 'Pusing kepala dan demam ringan.', 'diagnosa' => '-', 'resep' => '-'],
            ['id' => 4, 'tanggal' => '2023-08-05', 'dokter' => 'Dr. Andi Saputra', 'poli' => 'Gigi', 'status' => 'Selesai', 'gejala' => 'Sakit gigi geraham bawah kanan.', 'diagnosa' => 'Karies Gigi', 'resep' => 'Amoxicillin 3x1, Ibuprofen 3x1 (bila sakit)'],
        ];

        $riwayatTerfilter = $semuaRiwayat;

        if ($tahunAktif !== 'all') {
            $riwayatTerfilter = array_filter($riwayatTerfilter, function ($item) use ($tahunAktif) {
                return date('Y', strtotime($item['tanggal'])) == $tahunAktif;
            });
        }

        if ($statusAktif !== 'all') {
            $riwayatTerfilter = array_filter($riwayatTerfilter, function ($item) use ($statusAktif) {
                return $item['status'] == $statusAktif;
            });
        }

        $riwayatTerfilter = array_values($riwayatTerfilter);

        return view('pages.pasien.riwayat_medis', [
            'riwayat' => $riwayatTerfilter,
            'tahunAktif' => $tahunAktif,
            'statusAktif' => $statusAktif,
        ]);
    }

    public function downloadPdf($id)
    {
        $semuaRiwayat = [
            ['id' => 1, 'tanggal' => '2024-05-20', 'dokter' => 'Dr. Ani Lestari', 'poli' => 'Paru', 'status' => 'Selesai', 'gejala' => 'Batuk kering yang tidak kunjung sembuh disertai sesak ringan.', 'diagnosa' => 'ISPA (Infeksi Saluran Pernapasan Akut)', 'resep' => 'Ambroxol 3x1, Paracetamol 3x1, Vitamin C 1x1'],
            ['id' => 2, 'tanggal' => '2024-01-15', 'dokter' => 'Dr. Budi Hartono', 'poli' => 'Penyakit Dalam', 'status' => 'Selesai', 'gejala' => 'Sakit ulu hati dan mual setelah makan pedas.', 'diagnosa' => 'Gastritis Akut', 'resep' => 'Omeprazole 1x1, Antasida 3x1'],
            ['id' => 3, 'tanggal' => '2023-11-10', 'dokter' => 'Dr. Sarah Wijaya', 'poli' => 'Umum', 'status' => 'Dibatalkan', 'gejala' => 'Pusing kepala dan demam ringan.', 'diagnosa' => '-', 'resep' => '-'],
            ['id' => 4, 'tanggal' => '2023-08-05', 'dokter' => 'Dr. Andi Saputra', 'poli' => 'Gigi', 'status' => 'Selesai', 'gejala' => 'Sakit gigi geraham bawah kanan.', 'diagnosa' => 'Karies Gigi', 'resep' => 'Amoxicillin 3x1, Ibuprofen 3x1 (bila sakit)'],
        ];

        $item = collect($semuaRiwayat)->firstWhere('id', $id);

        if (!$item) {
            return abort(404, 'Data tidak ditemukan');
        }

        $pdf = Pdf::loadView('pages.pasien.pdf_riwayat', ['data' => $item]);

        return $pdf->download('rekam-medis-' . $item['id'] . '.pdf');
    }
}