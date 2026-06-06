<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class AntrianDokterController extends Controller
{
    public function index(Request $request)
    {
        $dokter = \App\Models\Dokter::where('email', session('email'))->first();
        $dokterId = $dokter ? $dokter->id : 0; 

        $tanggal = $request->input('tanggal', now()->format('Y-m-d'));

        $antrians = Antrian::with('pemesanan', 'rekamMedis')
            ->whereHas('pemesanan', function($query) use ($dokterId, $tanggal) {
                $query->where('dokter_id', $dokterId)
                      ->where('tanggal', $tanggal);
            })
            ->orderBy('nomor_antrian', 'asc')
            ->get();

        return view('pages.dokter.antrian_pasien', compact('antrians', 'tanggal'));
    }

    public function simpanRekamMedis(Request $request)
{
    $request->validate([
        'antrian_id' => 'required|exists:antrians,id',
        'status' => 'required|in:menunggu,selesai', // Cuma 2 opsi
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

    RekamMedis::updateOrCreate(['antrian_id' => $antrian->id], [
        'diagnosa'       => $request->diagnosa,
        'catatan_dokter' => $request->catatan_dokter,
        'resep_obat'     => $resepObat,
    ]);

    $antrian->status = $request->status; 
    $antrian->save();

    if ($antrian->pemesanan && $request->status === 'selesai') {
        $antrian->pemesanan->update(['status' => 'Selesai']);
    }

    return response()->json([
        'success' => true,
        'message' => 'Berhasil disimpan!',
        'antrian_id' => $antrian->id,
        'status' => $request->status,
        'diagnosa' => $request->diagnosa,
        'catatan' => $request->catatan_dokter,
        'resep' => $resepObat
    ]);
    }
}