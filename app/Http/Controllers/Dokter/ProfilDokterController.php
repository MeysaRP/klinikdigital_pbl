<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\User;

class ProfilDokterController extends Controller
{
    public function index()
    {
        $dokterId = session('id');
        
        $dokter = User::find($dokterId);

        if (!$dokter || $dokter->role !== 'dokter') {
            return redirect()->route('login');
        }

        return view('pages.dokter.profil', compact('dokter'));
    }
}