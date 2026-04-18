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
        return view('login');
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

            if ($user->role == 'admin') {
                return redirect('/dashboard/admin')->with('success', 'Berhasil masuk sebagai Admin');
            } elseif ($user->role == 'dokter') {
                return redirect('/dashboard/dokter')->with('success', 'Berhasil masuk sebagai Dokter');
            } else {
                return redirect('/dashboard_pasien')->with('success', 'Berhasil masuk sebagai Pasien');
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

        return redirect('/login');
    }

    // FORM LUPA PASSWORD
    public function forgotForm()
    {
        return view('forgot-password');
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

        return redirect('/login')->with('success', 'Password berhasil diubah!');
    }
}