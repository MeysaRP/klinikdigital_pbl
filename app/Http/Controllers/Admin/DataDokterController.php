<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Dokter; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataDokterController extends Controller
{
    public function index() 
    { 
        return view('pages.admin.data_dokter', [
            'dokters' => Dokter::orderBy('id')->get()
        ]); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:dokters,email', 
            'no_str' => 'nullable',
            'no_hp' => 'nullable',
            'status' => 'required',
            'password' => 'required|min:6',
        ]);

        $dokter = Dokter::create([
            'nama' => $request->name,
            'email' => $request->email,
            'str' => $request->no_str,
            'no_hp' => $request->no_hp,
            'status' => $request->status,
            'password' => bcrypt($request->password),
        ]);

        return response()->json($dokter);
    }

    public function update(Request $request, Dokter $dokter)
    {
        $v = $request->validate([
            'email'   => 'required|email|unique:dokters,email,'.$dokter->id,
            'name'    => 'required',
            'no_str'  => 'required',
            'no_hp'   => 'required',
            'status'  => 'required',
            'password'=> 'nullable|min:6'
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

        return response()->json($dokter);
    }
}