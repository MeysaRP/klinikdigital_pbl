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
        $rules = [
            'email'        => 'required|email|unique:users,email',
            'name'         => 'required|string|max:255',
            'alamat'       => 'required|string|max:500',
            'tgl_lahir'    => 'required|date',
            'jk'           => 'required|in:Laki-laki,Perempuan',
            'no_hp'        => 'required|string|max:25|unique:users,no_hp',
            'kategori'     => 'required|in:Mahasiswa,Dosen,Staff TU',
            'password'     => 'required|min:6|confirmed',
        ];

        $messages = [
            'email.required'        => 'Email wajib diisi!',
            'email.email'           => 'Format email tidak valid!',
            'email.unique'          => 'Email sudah digunakan!',
            'name.required'         => 'Nama wajib diisi!',
            'alamat.required'       => 'Alamat wajib diisi!',
            'tgl_lahir.required'    => 'Tanggal lahir wajib diisi!',
            'jk.required'           => 'Jenis kelamin wajib dipilih!',
            'no_hp.required'        => 'No HP wajib diisi!',
            'no_hp.unique'          => 'No HP sudah digunakan!',
            'kategori.required'     => 'Kategori wajib dipilih!',
            'password.required'     => 'Password wajib diisi!',
            'password.min'          => 'Password minimal 6 karakter!',
            'password.confirmed'    => 'Konfirmasi password tidak cocok!',
        ];

        if ($request->kategori === 'Mahasiswa') {
            $rules['no_identitas'] = 'required|digits:10|unique:users,no_identitas';
            $messages['no_identitas.required'] = 'NIM wajib diisi!';
            $messages['no_identitas.digits']   = 'NIM wajib 10 digit angka!';
            $messages['no_identitas.unique']   = 'NIM sudah digunakan!';
        } else {
            $rules['no_identitas'] = 'required|digits:16|unique:users,no_identitas';
            $messages['no_identitas.required'] = 'NIK wajib diisi!';
            $messages['no_identitas.digits']   = 'NIK wajib 16 digit angka!';
            $messages['no_identitas.unique']   = 'NIK sudah digunakan!';
        }

        $request->validate($rules, $messages);

        User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'alamat'       => $request->alamat,
            'tgl_lahir'    => $request->tgl_lahir,
            'jk'           => $request->jk,
            'no_hp'        => $request->no_hp,
            'kategori'     => $request->kategori,
            'no_identitas' => $request->no_identitas,
            'role'         => 'pasien',
            'password'     => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }
}