<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Dokter;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::with('dokter')->get();
        $dokters = Dokter::orderBy('nama')->get();

        return view('pages.admin.data_jadwal', compact('jadwal', 'dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dokter_id'    => 'required|exists:dokters,id',
            'hari'         => 'required',
            'jam_mulai'    => 'required',
            'jam_selesai'  => 'required',
            'kuota_pasien' => 'required|integer',
            'status'       => 'required',
        ]);

        Jadwal::create([
            'dokter_id'    => $request->dokter_id,
            'hari'         => $request->hari,
            'jam_mulai'    => $request->jam_mulai,
            'jam_selesai'  => $request->jam_selesai,
            'kuota_pasien' => $request->kuota_pasien,
            'status'       => $request->status,
        ]);

        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dokter_id'    => 'required|exists:dokters,id',
            'hari'         => 'required',
            'jam_mulai'    => 'required',
            'jam_selesai'  => 'required',
            'kuota_pasien' => 'required|integer',
            'status'       => 'required',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update([
            'dokter_id'    => $request->dokter_id,
            'hari'         => $request->hari,
            'jam_mulai'    => $request->jam_mulai,
            'jam_selesai'  => $request->jam_selesai,
            'kuota_pasien' => $request->kuota_pasien,
            'status'       => $request->status,
        ]);

        return redirect()->back()->with('success', 'Jadwal berhasil diupdate');
    }
}