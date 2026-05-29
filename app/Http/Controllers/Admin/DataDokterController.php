<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataDokterController extends Controller
{
    public function index() { return view('pages.admin.data_dokter', ['dokters' => Dokter::orderBy('id')->get()]); }

    public function store(Request $request)
    {
        $v = $request->validate(['email'=>'required|email|unique:dokters,email','nama'=>'required','str'=>'required','no_hp'=>'required','status'=>'required','password'=>'required|min:6']);
        return response()->json(Dokter::create(['email'=>$v['email'],'nama'=>$v['nama'],'str'=>$v['str'],'no_hp'=>$v['no_hp'],'status'=>$v['status'],'password'=>Hash::make($v['password'])]));
    }

    public function update(Request $request, Dokter $dokter)
    {
        $v = $request->validate(['email'=>'required|email|unique:dokters,email,'.$dokter->id,'nama'=>'required','str'=>'required','no_hp'=>'required','status'=>'required','password'=>'nullable|min:6']);
        $dokter->email = $v['email']; $dokter->nama = $v['nama']; $dokter->str = $v['str']; $dokter->no_hp = $v['no_hp']; $dokter->status = $v['status'];
        if (!empty($v['password'])) $dokter->password = Hash::make($v['password']);
        $dokter->save();
        return response()->json($dokter);
    }
}