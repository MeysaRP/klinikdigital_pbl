<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilPasienController extends Controller
{
    public function index()
    {
        $profil = session()->get('profil', [
            'nama' => 'Andi Pratama Rayhan',
            'tgl_lahir' => '2000-11-16',
            'jk' => 'Laki-laki',
            'no_hp' => '082124456789',
            'alamat' => 'Jl. Kestung No.15, Pretanteru',
        ]);

        return view('pages.pasien.profil', compact('profil'));
    }

    public function update(Request $request)
    {
        $data = [
            'nama' => $request->nama ?: 'Andi Pratama Rayhan',
            'tgl_lahir' => $request->tgl_lahir ?: '2000-11-16',
            'jk' => $request->jk ?: 'Laki-laki',
            'no_hp' => $request->no_hp ?: '082124456789',
            'alamat' => $request->alamat ?: 'Jl. Kestung No.15, Pretanteru',
        ];

        session()->put('profil', $data);

        return redirect()->route('pasien.profil')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}