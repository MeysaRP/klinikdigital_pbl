<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

        // CEK USER BERDASARKAN USERNAME & ROLE
        $user = User::where('username', $request->username)
            ->where('role', $request->role)
            ->first();

        // CEK PASSWORD HASH
        if ($user && Hash::check($request->password, $user->password)) {

            // SIMPAN SESSION
            session([
                'login' => true,
                'role' => $user->role,
                'username' => $user->username,
            ]);

            // REDIRECT BERDASARKAN ROLE
            if ($user->role === 'admin') {
                return redirect('/dashboard/admin');
            }

            elseif ($user->role === 'dokter') {
                return redirect('/dashboard/dokter');
            }

            return redirect('/dashboard/pasien');
        }

        return back()->with('error', 'Username / password / role salah!');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        $request->session()->flush();

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