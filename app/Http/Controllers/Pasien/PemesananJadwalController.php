<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\PemesananJadwal;
use App\Models\Antrian;
use App\Models\User;
use Illuminate\Http\Request;

class PemesananJadwalController extends Controller
{
    public function index()
    {
        $email = session('email');
        $user = User::where('email', $email)->first();
        $jadwals = Jadwal::with('dokter')->where('status', 'Aktif')->get();
        $bookings = [];

        if ($email) {
            $bookings = PemesananJadwal::with(['dokter', 'jadwal'])
                ->where('email', $email)
                ->orderByDesc('tanggal')
                ->orderByDesc('nomor_antrian')
                ->get();
        }

        return view('pages.pasien.pemesanan_jadwal', [
            'jadwals' => $jadwals,
            'bookings' => $bookings,
            'userName' => $user?->name ?? 'Pasien',
            'userRole' => 'Pasien',
            'userInitial' => $user ? substr($user->name, 0, 2) : 'PS',
        ]);
    }

    public function proses(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'jadwal_id' => 'required|exists:jadwals,id',
            'keluhan' => 'nullable|string|max:500',
        ], [
            'tanggal.required' => 'Tanggal harus dipilih!',
            'tanggal.date' => 'Format tanggal tidak valid!',
            'tanggal.after_or_equal' => 'Tanggal harus hari ini atau nanti.',
            'jadwal_id.required' => 'Pilih jadwal dokter terlebih dahulu!',
            'jadwal_id.exists' => 'Jadwal dokter tidak ditemukan.',
        ]);

        $email = session('email');
        $user = User::where('email', $email)->first();

        $jadwal = Jadwal::with('dokter')->findOrFail($request->jadwal_id);

        if ($jadwal->status !== 'Aktif') {
            return back()->with('error', 'Jadwal dokter tidak aktif. Silakan pilih jadwal lain.');
        }

        $jumlahBooking = PemesananJadwal::where('jadwal_id', $jadwal->id)
            ->where('tanggal', $request->tanggal)
            ->where('status', 'Menunggu')
            ->count();

        if ($jumlahBooking >= $jadwal->kuota_pasien) {
            return back()->with('error', 'Kuota pasien untuk jadwal ini sudah penuh. Silakan pilih jadwal lain.');
        }

        $nomorAntrian = $jumlahBooking + 1;

        $booking = PemesananJadwal::create([
            'user_id' => $user?->id,
            'dokter_id' => $jadwal->dokter_id,
            'jadwal_id' => $jadwal->id,
            'email' => $email,
            'nama_pasien' => $user?->name,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $jadwal->jam_mulai,
            'jam_selesai' => $jadwal->jam_selesai,
            'nomor_antrian' => $nomorAntrian,
            'keluhan' => $request->keluhan,
            'status' => 'Menunggu',
        ]);

        // Simpan ke tabel antrians
        Antrian::create([
            'pemesanan_id' => $booking->id,
            'nomor_antrian' => 'A' . str_pad($nomorAntrian, 3, '0', STR_PAD_LEFT),
            'status' => 'menunggu',
        ]);

        return redirect()->route('pemesanan.berhasil', [
            'booking' => $booking->id
        ]);
    }

    public function berhasil($bookingId)
    {
        $email = session('email');
        $user = User::where('email', $email)->first();

        $booking = PemesananJadwal::with(['dokter', 'jadwal'])
            ->where('id', $bookingId)
            ->where('email', $email)
            ->firstOrFail();

        return view('pages.pasien.pemesanan_berhasil', [
            'booking' => $booking,
            'userName' => $user?->name ?? 'Pasien',
            'userRole' => 'Pasien',
            'userInitial' => $user ? substr($user->name, 0, 2) : 'PS',
        ]);
    }

    public function batal($bookingId)
    {
        $email = session('email');

        $booking = PemesananJadwal::where('id', $bookingId)
            ->where('email', $email)
            ->where('status', 'Menunggu')
            ->first();

        if (!$booking) {
            return back()->with('error', 'Pemesanan tidak ditemukan atau tidak dapat dibatalkan.');
        }

        $booking->status = 'Dibatalkan';
        $booking->save();

        return back()->with('success', 'Pemesanan berhasil dibatalkan.');
    }
}