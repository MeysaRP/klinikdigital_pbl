<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Tampilkan halaman login
    public function index()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        // Data login
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        // Coba login
        if (Auth::attempt($credentials)) {

            // Ambil user yang login
            $user = Auth::user();

            // Cek role
            if ($user->role == $request->role) {

                // Redirect sesuai role
                if ($user->role == 'admin') {
                    return redirect('/dashboard/admin');
                } elseif ($user->role == 'dokter') {
                    return redirect('/dashboard/dokter');
                } else {
                    return redirect('/dashboard_pasien');
                }

            } else {
                Auth::logout();
                return back()->with('error', 'Role tidak sesuai!');
            }
        }

        return back()->with('error', 'Username atau password salah!');
    }

    // TAMBAHKAN FUNGSI INI
    public function logout(Request $request)
    {
        Auth::logout(); // Proses logout user

        // Agar session lama tidak bisa dipakai lagi (keamanan)
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Kembali ke halaman utama
        return redirect('/');
    }
}