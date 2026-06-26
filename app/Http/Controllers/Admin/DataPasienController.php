<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DataPasienController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'pasien');

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $pasien = $query->orderBy('id', 'desc')->get();

        return view('pages.admin.data_pasien', compact('pasien'));
    }

    public function update(Request $request, $id)
    {
        $pasien = User::where('role', 'pasien')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'jk' => 'required|string|max:20',
        ]);

        $pasien->update([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'tgl_lahir' => $request->tgl_lahir,
            'jk' => $request->jk,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data pasien berhasil diperbarui'
        ]);
    }
}