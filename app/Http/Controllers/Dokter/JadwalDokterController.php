<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;

class JadwalDokterController extends Controller
{
    public function index()
    {
        return view('pages.dokter.jadwal_saya');
    }
}