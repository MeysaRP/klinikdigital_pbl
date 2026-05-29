<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrasiController extends Controller
{
    public function index()
    {
        return view('pages.registrasi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'required|string|max:25',
            'kategori' => 'required|in:Mahasiswa,Dosen,Staff TU',
            'no_identitas' => 'required|string|max:100',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'tgl_lahir' => $request->tgl_lahir,
            'no_hp' => $request->no_hp,
            'kategori' => $request->kategori,
            'no_identitas' => $request->no_identitas,
            'role' => 'pasien',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }
}