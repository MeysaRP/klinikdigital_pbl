<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Dokter;
use Illuminate\Http\Request;

class DataJadwalController extends Controller
{
    // Menampilkan halaman data jadwal beserta data dokter
    public function index()
    {
        return view('pages.admin.data_jadwal', [
            'jadwal' => Jadwal::with('dokter')->get(),
            'dokters' => Dokter::orderBy('nama')->get(),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'kuota_pasien' => 'required|integer',
            'status' => 'required',
        ]);
        Jadwal::create($request->only(
            'dokter_id',
            'hari',
            'jam_mulai',
            'jam_selesai',
            'kuota_pasien',
            'status'
        ));

        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'kuota_pasien' => 'required|integer',
            'status' => 'required',
        ]);

        // Mencari jadwal berdasarkan ID dan mengupdate datanya
        Jadwal::findOrFail($id)->update($request->only(
            'dokter_id',
            'hari',
            'jam_mulai',
            'jam_selesai',
            'kuota_pasien',
            'status'
        ));

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Jadwal berhasil diupdate');
    }
}