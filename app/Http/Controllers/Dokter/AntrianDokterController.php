<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class AntrianDokterController extends Controller
{
    public function index()
    {
        $antrians = Antrian::with('pemesanan', 'rekamMedis')
            ->orderBy('id')
            ->get();

        return view('pages.dokter.antrian_pasien', compact('antrians'));
    }

    public function simpanRekamMedis(Request $request)
{
    $request->validate([
        'antrian_id' => 'required|exists:antrians,id',
        'diagnosa' => 'required',
        'catatan_dokter' => 'nullable',
    ]);

    $antrian = Antrian::with('pemesanan')->findOrFail($request->antrian_id);

    $resepObat = [];
    if ($request->has('obat_nama')) {
        for ($i = 0; $i < count($request->obat_nama); $i++) {
    
            if (!empty($request->obat_nama[$i])) {
                $resepObat[] = [
                    'nama_obat'   => $request->obat_nama[$i],
                    'dosis'       => $request->obat_dosis[$i] ?? '-',
                    'keterangan'  => $request->obat_ket[$i] ?? '-'
                ];
            }
        }
    }

    RekamMedis::updateOrCreate([
        'antrian_id' => $antrian->id,
    ], [
        'diagnosa'       => $request->diagnosa,
        'catatan_dokter' => $request->catatan_dokter,
        'resep_obat'     => $resepObat,
    ]);

    $antrian->status = $request->status; 
    $antrian->save();

    if ($antrian->pemesanan) {
        $booking = $antrian->pemesanan;
        $booking->status = 'Selesai';
        $booking->save();
    }

    return back()->with('success', 'Rekam medis berhasil disimpan.');
}
}