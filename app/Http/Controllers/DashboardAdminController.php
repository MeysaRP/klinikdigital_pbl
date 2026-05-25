<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    // ================= DASHBOARD =================
    public function index()
    {
        return view('pages.admin.dashboard_admin');
    }
}