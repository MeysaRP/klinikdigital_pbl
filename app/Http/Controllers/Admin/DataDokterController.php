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
            'dokters' => User::where('role', 'dokter')->orderBy('id')->get()
        ]); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users|unique:dokters', 
            'no_str' => 'nullable',
            'no_hp' => 'nullable',
            'status' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_str' => $request->no_str,
            'no_hp' => $request->no_hp,
            'status' => $request->status,
            'password' => bcrypt($request->password),
            'role' => 'dokter',
        ]);

        Dokter::create([
            'nama' => $request->name,      
            'email' => $request->email,
            'str' => $request->no_str,     
            'no_hp' => $request->no_hp,
            'status' => $request->status,
            'password' => bcrypt($request->password),
        ]);

        return response()->json($user);
    }

    public function update(Request $request, User $dokter) 
    {
        $v = $request->validate([
            'email'   => 'required|email|unique:users,email,'.$dokter->id, 
            'name'    => 'required', 
            'no_str'  => 'required', 
            'no_hp'   => 'required',
            'status'  => 'required',
            'password'=> 'nullable|min:6'
        ]);
        
        $dokter->email = $v['email']; 
        $dokter->name = $v['name'];     
        $dokter->no_str = $v['no_str']; 
        $dokter->no_hp = $v['no_hp']; 
        $dokter->status = $v['status'];
        
        if (!empty($v['password'])) {
            $dokter->password = Hash::make($v['password']);
        }
        $dokter->save();

        $dokterData = Dokter::where('email', $request->email)->first();
        if ($dokterData) {
            $dokterData->nama = $v['name'];
            $dokterData->email = $v['email'];
            $dokterData->str = $v['no_str'];
            $dokterData->no_hp = $v['no_hp'];
            $dokterData->status = $v['status'];
            if (!empty($v['password'])) {
                $dokterData->password = Hash::make($v['password']);
            }
            $dokterData->save();
        }
        
        return response()->json($dokter);
    }
}