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

        $kategori = $user->kategori ?? '-';
        if ($kategori === 'Staff TU') {
            $kategori = 'Tenaga Kependidikan';
        }

        $initials = 'PS';
        if ($user && $user->name) {
            $words = explode(' ', trim($user->name));
            $initials = strtoupper(substr($words[0], 0, 1));
            if (count($words) > 1) {
                $initials .= strtoupper(substr($words[1], 0, 1));
            }
        }

        $profil = [
            'nama' => $user->name,
            'email' => $user->email,
            'tgl_lahir' => $user->tgl_lahir ?? now()->subYears(20)->format('Y-m-d'),
            'jk' => $user->jk ?? 'Laki-laki',
            'no_hp' => $user->no_hp ?? '-',
            'alamat' => $user->alamat ?? '-',
            'kategori' => $kategori,
        ];

        return view('pages.pasien.profil', [
            'profil'      => $profil,
            'userName'    => $user->name ?? 'Pasien',
            'userRole'    => 'Pasien',
            'userInitial' => $initials,
        ]);
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