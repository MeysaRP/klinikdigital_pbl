<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataDokterController extends Controller
{
    public function index()
    {
        // DATA DUMMY (sementara frontend dulu)
        $dokters = [
            [
                'id' => 'D01',
                'nama' => 'Dr. Sarah',
                'str' => '1234567',
                'no_hp' => '081234567',
                'status' => 'Aktif'
            ],
            [
                'id' => 'D02',
                'nama' => 'Dr. Budi',
                'str' => '1234567',
                'no_hp' => '081234567',
                'status' => 'Aktif'
            ],
            [
                'id' => 'D03',
                'nama' => 'Dr. Rina',
                'str' => '1234567',
                'no_hp' => '081234567',
                'status' => 'Nonaktif'
            ],
            [
                'id' => 'D04',
                'nama' => 'Dr. Aila',
                'str' => '1234567',
                'no_hp' => '081234567',
                'status' => 'Aktif'
            ],
            [
                'id' => 'D05',
                'nama' => 'Dr. Sutomo',
                'str' => '1234567',
                'no_hp' => '081234567',
                'status' => 'Nonaktif'
            ],
        ];

       return view('pages.admin.data_dokter', compact('dokters'));
    }
}