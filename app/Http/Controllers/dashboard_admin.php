<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard_adminController extends Controller
{
    public function index()
    {
        return view('dashboard_admin');
    }
}