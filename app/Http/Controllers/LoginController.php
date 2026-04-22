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
        // UBAH PATH VIEW
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

                // simpan session
                session([
                    'login' => true,
                    'role' => $user['role'],
                ]);

                // redirect sesuai role
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
    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // PERBAIKI REDIRECT: Dulu /login, sekarang /auth/login
        return redirect()->route('login');
    }

    // FORM LUPA PASSWORD
    public function forgotForm()
    {
        // UBAH PATH VIEW
        return view('pages.forgot-password');
    }

    // RESET PASSWORD PAKAI NO HP
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

        // PERBAIKI REDIRECT
        return redirect()->route('login')->with('success', 'Password berhasil diubah!');
    }
}