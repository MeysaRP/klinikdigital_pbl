<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;

class ProfilDokterController extends Controller
{
    public function index()
    {
        return view('pages.dokter.profil');
    }
}