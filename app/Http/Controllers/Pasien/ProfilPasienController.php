<?php
namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilPasienController extends Controller
{
    public function index()
    {
        $email = session('email');
        $user = User::where('email', $email)->firstOrFail();

        $profil = [
            'nama' => $user->name,
            'email' => $user->email,
            'tgl_lahir' => $user->tgl_lahir ?? now()->subYears(20)->format('Y-m-d'),
            'jk' => $user->jk ?? 'Laki-laki',
            'no_hp' => $user->no_hp ?? '-',
            'alamat' => $user->alamat ?? '-',
        ];

        return view('pages.pasien.profil', compact('profil'));
    }

    public function update(Request $request)
    {
        $user = User::where('email', session('email'))->firstOrFail();

        $user->name = $request->nama ?: $user->name;
        $user->tgl_lahir = $request->tgl_lahir ?: $user->tgl_lahir;
        $user->jk = $request->jk ?: $user->jk;
        $user->no_hp = $request->no_hp ?: $user->no_hp;
        $user->alamat = $request->alamat ?: $user->alamat;
        $user->save();

        return redirect()->route('pasien.profil')->with('success', 'Profil berhasil diperbarui!');
    }
}