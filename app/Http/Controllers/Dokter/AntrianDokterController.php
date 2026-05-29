<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;

class AntrianDokterController extends Controller
{
    public function index()
    {
        return view('pages.dokter.antrian_pasien');
    }
}