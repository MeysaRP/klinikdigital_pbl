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
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            // PERBAIKI REDIRECT: Sesuaikan dengan Route::prefix yang baru
            if ($user->role == 'admin') {
                return redirect()->route('dashboard.admin')->with('success', 'Berhasil masuk sebagai Admin');
            } elseif ($user->role == 'dokter') {
                return redirect()->route('dashboard.dokter')->with('success', 'Berhasil masuk sebagai Dokter');
            } else {
                // YANG INI DULU /dashboard_pasien, SEKARANG JADI /dashboard/pasien
                return redirect()->route('dashboard.pasien')->with('success', 'Berhasil masuk sebagai Pasien');
            }
        }

        return back()->with('error', 'Username atau password salah!');
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