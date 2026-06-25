<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class AntrianPasienController extends Controller
{
    // Fungsi untuk menampilkan daftar antrian pasien
    public function index(Request $request)
    {
        // Ambil data dokter berdasarkan email dari session
        $dokter = Dokter::where('email', session('email'))->first();
        $dokterId = $dokter ? $dokter->id : 0;

        // Ambil tanggal dari request atau gunakan tanggal saat ini
        $tanggal = $request->input('tanggal', now()->format('Y-m-d'));

        // Ambil data antrian pasien berdasarkan dokter dan tanggal
        $antrians = Antrian::with('pemesanan', 'rekamMedis')
            ->whereHas('pemesanan', function($query) use ($dokterId, $tanggal) {
                $query->where('dokter_id', $dokterId)
                      ->where('tanggal', $tanggal);
            })
            ->orderBy('nomor_antrian', 'asc')
            ->get();

        // YANG DITAMBAHKAN: kirim data untuk layout (sidebar/topbar)
        return view('pages.dokter.antrian_pasien', [
            'antrians'     => $antrians,
            'tanggal'      => $tanggal,
            'userName'     => $dokter->nama ?? 'Dokter',
            'userRole'     => 'Dokter',
            'userInitial'  => $dokter ? strtoupper(substr($dokter->nama, 0, 2)) : 'DK',
        ]);
    }
    
    // Fungsi untuk menyimpan rekam medis pasien
    public function simpanRekamMedis(Request $request)
    {
        // Validasi input 
        $request->validate([
            'antrian_id' => 'required|exists:antrians,id',
            'status' => 'required|in:menunggu,selesai',
            'diagnosa' => 'required',
            'catatan_dokter' => 'nullable',
        ]);

        // Ambil data antrian berdasarkan ID
        $antrian = Antrian::with('pemesanan')->findOrFail($request->antrian_id);

        // Simpan data resep obat 
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
        // Simpan data rekam medis
        RekamMedis::updateOrCreate(['antrian_id' => $antrian->id], [
            'diagnosa'       => $request->diagnosa,
            'catatan_dokter' => $request->catatan_dokter,
            'resep_obat'     => $resepObat,
        ]);

        // Update status antrian
        $antrian->status = $request->status;
        $antrian->save();
        
        // Jika status antrian diubah menjadi 'selesai', update status pemesanan menjadi 'Selesai'
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