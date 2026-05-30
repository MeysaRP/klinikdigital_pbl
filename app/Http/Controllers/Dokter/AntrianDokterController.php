<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Antrian;

class AntrianDokterController extends Controller
{
    public function index()
    {
        $antrians = Antrian::with('pemesanan')
            ->orderBy('id')
            ->get();

        return view('pages.dokter.antrian_pasien', compact('antrians'));
    }
}