<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // HALAMAN LOGIN
    public function index()
    {
        return view('pages.login');
    }

    // PROSES LOGIN
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ], [
            'username.required' => 'Username wajib diisi!',
            'password.required' => 'Password wajib diisi!',
            'role.required' => 'Role wajib dipilih!',
        ]);

        // DATA DUMMY
        $users = [
            ['username' => 'admin', 'password' => '123', 'role' => 'admin'],
            ['username' => 'dokter', 'password' => '123', 'role' => 'dokter'],
            ['username' => 'pasien', 'password' => '123', 'role' => 'pasien'],
        ];

        foreach ($users as $user) {
            if (
                $request->username === $user['username'] &&
                $request->password === $user['password'] &&
                $request->role === $user['role']
            ) {

                // SIMPAN SESSION
                session([
                    'login' => true,
                    'role' => $user['role'],
                ]);

                // REDIRECT SESUAI ROLE
                if ($user['role'] === 'admin') {
                    return redirect('/dashboard/admin');
                } elseif ($user['role'] === 'dokter') {
                    return redirect('/dashboard/dokter');
                } else {
                    return redirect('/dashboard/pasien');
                }
            }
        }

        return back()->with('error', 'Username / password / role salah!');
    }

    // ✅ LOGOUT (SUDAH DIPERBAIKI TOTAL)
    public function logout(Request $request)
    {
        // HAPUS SEMUA SESSION (karena kamu pakai manual session)
        $request->session()->flush();

        // OPTIONAL (biar lebih aman)
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // FORM LUPA PASSWORD
    public function forgotForm()
    {
        return view('pages.forgot-password');
    }

    // RESET PASSWORD
    public function resetPassword(Request $request)
    {
        $request->validate([
            'no_hp' => 'required',
            'password' => 'required|min:5',
        ]);

        $user = User::where('no_hp', $request->no_hp)->first();

        if (!$user) {
            return back()->with('error', 'Nomor tidak ditemukan!');
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password berhasil diubah!');
    }
}