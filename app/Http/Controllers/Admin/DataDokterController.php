<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataDokterController extends Controller
{
    // Menampilkan daftar dokter
    public function index()
    {
        return view('pages.admin.data_dokter', [
            'dokters' => Dokter::orderBy('id')->get()
        ]);
    }

    // Menambahkan dokter baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:dokters,email|unique:users,email',
            'no_str' => 'required',
            'no_hp' => 'required',
            'password' => 'required|min:6',
        ], [
            'name.required' => 'Nama dokter wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah digunakan!',
            'no_str.required' => 'No. STR wajib diisi!',
            'no_hp.required' => 'No. HP wajib diisi!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 6 karakter!',
        ]);

        // Buat user untuk login dokter
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_str' => $request->no_str,
            'no_hp' => $request->no_hp,
            'status' => 'Aktif',
            'role' => 'dokter',
            'password' => Hash::make($request->password),
        ]);

        // Buat data dokter
        $dokter = Dokter::create([
            'nama' => $request->name,
            'email' => $request->email,
            'str' => $request->no_str,
            'no_hp' => $request->no_hp,
            'status' => 'Aktif',
            'password' => Hash::make($request->password),
        ]);

        return response()->json($dokter);
    }

    // Mengupdate data dokter
    public function update(Request $request, Dokter $dokter)
    {
        $userLama = User::where('email', $dokter->email)->first();
        $idUserLama = $userLama ? $userLama->id : 'NULL';

        $v = $request->validate([
            'email'   => 'required|email|unique:dokters,email,'.$dokter->id.'|unique:users,email,'.$idUserLama,
            'name'    => 'required',
            'no_str'  => 'required',
            'no_hp'   => 'required',
            'status'  => 'required|in:Aktif,Nonaktif',
            'password'=> 'nullable|min:6'
        ], [
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah digunakan!',
            'name.required' => 'Nama dokter wajib diisi!',
            'no_str.required' => 'No. STR wajib diisi!',
            'no_hp.required' => 'No. HP wajib diisi!',
            'password.min' => 'Password minimal 6 karakter!',
        ]);

        $dokter->email = $v['email'];
        $dokter->nama = $v['name'];
        $dokter->str = $v['no_str'];
        $dokter->no_hp = $v['no_hp'];
        $dokter->status = $v['status'];

        if (!empty($v['password'])) {
            $dokter->password = Hash::make($v['password']);
        }

        $dokter->save();

        if ($userLama) {
            $userLama->name = $v['name'];
            $userLama->email = $v['email'];
            $userLama->no_str = $v['no_str'];
            $userLama->no_hp = $v['no_hp'];
            $userLama->status = $v['status'];

            if (!empty($v['password'])) {
                $userLama->password = Hash::make($v['password']);
            }

            $userLama->save();
        }

        return response()->json($dokter);
    }
}