<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard_pasienController extends Controller
{
    public function index()
    {
        return view('dashboard_pasien');
    }
}