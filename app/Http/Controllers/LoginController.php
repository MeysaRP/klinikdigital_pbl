<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Dokter;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ], [
            'email.required' => 'Email wajib diisi!',
            'password.required' => 'Password wajib diisi!',
            'role.required' => 'Role wajib dipilih!',
        ]);

        $user = User::where('email', $request->email)->where('role', $request->role)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'login' => true,
                'role' => $user->role,
                'email' => $user->email,
            ]);

            if ($user->role === 'admin') return redirect('/dashboard/admin');
            if ($user->role === 'dokter') return redirect('/dashboard/dokter');
            return redirect('/dashboard/pasien');
        }

        return back()->with('error', 'Email / password / role salah!');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function forgotForm()
    {
        return view('pages.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
        ]);

        $email = $request->email;
        $user = User::where('email', $email)->first();
        $dokter = Dokter::where('email', $email)->first();

        if ($user || $dokter) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            $token = Str::random(60);
            DB::table('password_reset_tokens')->insert([
                'email' => $email,
                'token' => Hash::make($token),
                'created_at' => now(),
            ]);
            $resetUrl = url('/auth/reset-password/' . $token . '?email=' . urlencode($email));

            try {
                Mail::to($email)->send(new ResetPasswordMail($resetUrl));
            } catch (TransportExceptionInterface $exception) {
                DB::table('password_reset_tokens')->where('email', $email)->delete();
                Log::error('Reset password email failed', ['email' => $email, 'error' => $exception->getMessage()]);
                return back()->with('error', 'Gagal mengirim email reset password. Cek konfigurasi mail (.env) atau gunakan Mailtrap untuk development.');
            } catch (\Exception $exception) {
                DB::table('password_reset_tokens')->where('email', $email)->delete();
                Log::error('Reset password email failed', ['email' => $email, 'error' => $exception->getMessage()]);
                return back()->with('error', 'Terjadi kesalahan saat mengirim email. Silakan coba lagi nanti.');
            }
        }

        return back()->with('success', 'Jika email terdaftar, link reset password telah dikirim.');
    }

    public function showResetForm(Request $request, $token)
    {
        $email = $request->query('email');
        if (!$email || !$token) return redirect()->route('forgot.password')->with('error', 'Link tidak valid.');

        $record = DB::table('password_reset_tokens')->where('email', $email)->first();
        if (!$record || !Hash::check($token, $record->token)) return redirect()->route('forgot.password')->with('error', 'Link tidak valid.');
        if (now()->subMinutes(60)->gt($record->created_at)) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            return redirect()->route('forgot.password')->with('error', 'Link sudah kadaluarsa.');
        }

        return view('pages.reset-password', ['token' => $token, 'email' => $email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ], [
            'password.required' => 'Password baru wajib diisi!',
            'password.min' => 'Password minimal 6 karakter!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
        ]);

        $email = $request->email;
        $record = DB::table('password_reset_tokens')->where('email', $email)->first();

        if (!$record || !Hash::check($request->token, $record->token)) return back()->with('error', 'Link tidak valid.');
        if (now()->subMinutes(60)->gt($record->created_at)) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            return back()->with('error', 'Link sudah kadaluarsa.');
        }

        $newPassword = Hash::make($request->password);

        $user = User::where('email', $email)->first();
        if ($user) { $user->password = $newPassword; $user->save(); }

        $dokter = Dokter::where('email', $email)->first();
        if ($dokter) { $dokter->password = $newPassword; $dokter->save(); }

        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return redirect()->route('login')->with('success', 'Password berhasil diubah!');
    }
}