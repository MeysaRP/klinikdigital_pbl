<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Dokter;

class ProfilDokterController extends Controller
{
    public function index()
    {
        $dokterId = session('id');

        // YANG DIPERBAIKI: dari User::find() diganti Dokter::find()
        $dokter = Dokter::find($dokterId);

        if (!$dokter) {
            return redirect()->route('login')->with('error', 'Data dokter tidak ditemukan.');
        }

        // YANG DITAMBAHKAN: kirim data untuk layout (sidebar/topbar)
        return view('pages.dokter.profil', [
            'dokter'      => $dokter,
            'userName'    => $dokter->nama,
            'userRole'    => 'Dokter',
            'userInitial' => strtoupper(substr($dokter->nama, 0, 2)),
        ]);
    }
}