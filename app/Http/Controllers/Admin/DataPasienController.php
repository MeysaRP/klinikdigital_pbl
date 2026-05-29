<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DataPasienController extends Controller
{
    public function index()
    {
        $pasien = [
            ['id' => 'P001', 'nama' => 'Andi', 'hp' => '081234567890', 'tgl' => '2000-04-10'],
            ['id' => 'P002', 'nama' => 'Budi', 'hp' => '081234567893', 'tgl' => '1999-04-09'],
            ['id' => 'P003', 'nama' => 'Citra', 'hp' => '081234567891', 'tgl' => '1985-04-08'],
            ['id' => 'P004', 'nama' => 'Doni', 'hp' => '081234567892', 'tgl' => '1997-04-07'],
            ['id' => 'P005', 'nama' => 'Eni', 'hp' => '081234567894', 'tgl' => '1975-04-06'],
        ];

        return view('pages.admin.data_pasien', compact('pasien'));
    }
}