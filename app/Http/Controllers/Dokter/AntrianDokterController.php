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
        $antrians = Antrian::with('pemesanan')
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

        RekamMedis::create([
            'antrian_id' => $request->antrian_id,
            'diagnosa' => $request->diagnosa,
            'catatan_dokter' => $request->catatan_dokter,
        ]);

        $antrian = Antrian::findOrFail($request->antrian_id);
        $antrian->status = 'selesai';
        $antrian->save();
        
        return back()->with('success', 'Rekam medis berhasil disimpan.');
    }
}