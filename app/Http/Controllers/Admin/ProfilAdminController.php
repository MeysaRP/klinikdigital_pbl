<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilAdminController extends Controller
{
    public function index()
    {
        $email = session('email');
        $user = User::where('email', $email)->first();

        if (!$user || $user->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Akun tidak ditemukan.');
        }

        $initials = 'AD';
        if ($user && $user->name) {
            $words = explode(' ', trim($user->name));
            $initials = strtoupper(substr($words[0], 0, 1));
            if (count($words) > 1) {
                $initials .= strtoupper(substr($words[1], 0, 1));
            }
        }

        return view('pages.admin.profil', [
            'user'        => $user,
            'userName'    => $user->name,
            'userRole'    => 'Admin',
            'userInitial' => $initials,
        ]);
    }

    public function update(Request $request)
    {
        $email = session('email');
        $user = User::where('email', $email)->first();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ], [
            'name.required'  => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.email'    => 'Format email tidak valid!',
            'email.unique'   => 'Email sudah digunakan!',
        ]);

        $user->update($request->only(['name', 'email']));

        session(['email' => $user->email, 'name' => $user->name]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}