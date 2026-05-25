<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataDokterController extends Controller
{
    public function index()
    {
        $dokters = Dokter::orderBy('id')->get();

        return view('pages.admin.data_dokter', compact('dokters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:dokters,username',
            'nama' => 'required|string|max:255',
            'str' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'password' => 'required|string|min:6',
        ]);

        $dokter = Dokter::create([
            'username' => $validated['username'],
            'nama' => $validated['nama'],
            'str' => $validated['str'],
            'no_hp' => $validated['no_hp'],
            'status' => $validated['status'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json($dokter);
    }

    public function update(Request $request, Dokter $dokter)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:dokters,username,' . $dokter->id,
            'nama' => 'required|string|max:255',
            'str' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'password' => 'nullable|string|min:6',
        ]);

        $dokter->username = $validated['username'];
        $dokter->nama = $validated['nama'];
        $dokter->str = $validated['str'];
        $dokter->no_hp = $validated['no_hp'];
        $dokter->status = $validated['status'];

        if (! empty($validated['password'])) {
            $dokter->password = Hash::make($validated['password']);
        }

        $dokter->save();

        return response()->json($dokter);
    }
}
