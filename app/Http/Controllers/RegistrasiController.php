<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrasiController extends Controller
{
    public function index()
    {
        return view('registrasi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'name' => 'required|string|max:255',
            'alamat' => 'required',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'alamat' => $request->alamat,
            'tgl_lahir' => $request->tgl_lahir,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('registrasi')->with('success', 'Registrasi berhasil!');
    }
}