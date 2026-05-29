<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;

class DashboardDokterController extends Controller
{
    public function index()
    {
        return view('pages.dokter.dashboard_dokter');
    }
}