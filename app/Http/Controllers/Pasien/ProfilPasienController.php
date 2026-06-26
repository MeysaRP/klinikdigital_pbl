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

        // Label dinamis NIM / NIK
        $labelIdentitas = '-';
        if ($kategori === 'Mahasiswa') {
            $labelIdentitas = 'NIM';
        } elseif (in_array($kategori, ['Dosen', 'Tenaga Kependidikan'])) {
            $labelIdentitas = 'NIK';
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
            'nama'         => $user->name,
            'email'        => $user->email,
            'no_identitas' => $user->no_identitas ?? '-',
            'tgl_lahir'    => $user->tgl_lahir ?? now()->subYears(20)->format('Y-m-d'),
            'jk'           => $user->jk ?? 'Laki-laki',
            'no_hp'        => $user->no_hp ?? '-',
            'alamat'       => $user->alamat ?? '-',
            'kategori'     => $kategori,
        ];

        return view('pages.pasien.profil', [
            'profil'         => $profil,
            'labelIdentitas' => $labelIdentitas,
            'userName'       => $user->name ?? 'Pasien',
            'userRole'       => 'Pasien',
            'userInitial'    => $initials,
        ]);
    }

    public function update(Request $request)
    {
        $user = User::where('email', session('email'))->firstOrFail();

        $request->validate([
            'nama'      => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'jk'        => 'required|in:Laki-laki,Perempuan',
            'no_hp'     => 'required|string|max:15',
            'alamat'    => 'required|string|min:3|not_in:-',
        ], [
            'nama.required'      => 'Data wajib diisi',
            'tgl_lahir.required' => 'Data wajib diisi',
            'jk.required'        => 'Data wajib diisi',
            'no_hp.required'     => 'Data wajib diisi',
            'alamat.required'    => 'Data wajib diisi',
            'alamat.min'         => 'Data wajib diisi',
            'alamat.not_in'      => 'Data wajib diisi',
        ]);

        // Update data setelah lolos validasi
        $user->name      = $request->nama;
        $user->tgl_lahir = $request->tgl_lahir;
        $user->jk        = $request->jk;
        $user->no_hp     = $request->no_hp;
        $user->alamat    = $request->alamat;
        $user->save();

        // Update session name biar langsung berubah di sidebar/topbar
        session(['name' => $request->nama]);

        return redirect()->route('pasien.profil')->with('success', 'Profil berhasil diperbarui!');
    }
}