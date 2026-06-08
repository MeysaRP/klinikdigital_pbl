<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\PemesananJadwal;
use App\Models\Antrian;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PemesananJadwalController extends Controller
{
    public function index(Request $request)
    {
        $email = session('email');
        $user = User::where('email', $email)->first();

        $selectedDate = $request->query('tanggal');
        $selectedDayName = null;

        $jadwalQuery = Jadwal::with('dokter')
            ->where('status', 'Aktif');

        if ($selectedDate) {
            try {
                $carbonDate = Carbon::parse($selectedDate);
                $dayMap = [
                    'Monday'    => 'senin',
                    'Tuesday'   => 'selasa',
                    'Wednesday' => 'rabu',
                    'Thursday'  => 'kamis',
                    'Friday'    => 'jumat',
                    'Saturday'  => 'sabtu',
                    'Sunday'    => 'minggu',
                ];
                $selectedDayName = $dayMap[$carbonDate->format('l')] ?? null;
                if ($selectedDayName) {
                    $jadwalQuery->whereRaw('LOWER(hari) = ?', [$selectedDayName]);
                }
            } catch (\Exception $e) {
                $selectedDate = null;
                $selectedDayName = null;
            }
        }

        $jadwals = $jadwalQuery
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();

        $urutanHari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];

        $jadwalPerHari = [];
        foreach ($urutanHari as $hari) {
            $filtered = $jadwals->filter(function ($j) use ($hari) {
                return strtolower($j->hari) === $hari;
            })->values();

            if ($filtered->isNotEmpty()) {
                $jadwalPerHari[] = [
                    'hari'    => ucfirst($hari),
                    'jumlah'  => $filtered->count(),
                    'jadwals' => $filtered,
                ];
            }
        }

        $bookings = collect();
        if ($email) {
            $bookings = PemesananJadwal::with(['dokter', 'jadwal'])
                ->where('email', $email)
                ->orderByDesc('tanggal')
                ->orderByDesc('nomor_antrian')
                ->get();
        }

        // Kirim tanggal yang sudah dipesan (status Menunggu) untuk diblokir di frontend
        $tanggalSudahDipesan = [];
        if ($email) {
            $tanggalSudahDipesan = PemesananJadwal::where('email', $email)
                ->where('status', 'Menunggu')
                ->pluck('tanggal')
                ->map(fn($t) => Carbon::parse($t)->format('Y-m-d'))
                ->unique()
                ->values()
                ->toArray();
        }

        return view('pages.pasien.pemesanan_jadwal', [
            'jadwalPerHari'        => $jadwalPerHari,
            'bookings'             => $bookings,
            'selectedDate'         => $selectedDate,
            'selectedDayName'      => $selectedDayName,
            'userName'             => $user?->name ?? 'Pasien',
            'userRole'             => 'Pasien',
            'userInitial'          => $user ? substr($user->name, 0, 2) : 'PS',
            'tanggalSudahDipesan'  => $tanggalSudahDipesan,
        ]);
    }

    public function proses(Request $request)
    {
        $request->validate([
            'tanggal'   => 'required|date|after_or_equal:today',
            'jadwal_id' => 'required|exists:jadwals,id',
            'keluhan'   => 'nullable|string|max:500',
        ]);

        $email = session('email');
        $user = User::where('email', $email)->first();

        // =============================================
        // CEK: Sudah pernah pesan di tanggal ini?
        // =============================================
        $sudahPesan = PemesananJadwal::where('email', $email)
            ->where('tanggal', $request->tanggal)
            ->where('status', 'Menunggu')
            ->exists();

        if ($sudahPesan) {
            return back()
                ->with('popup_error', 'Pemesanan sudah dilakukan pada hari ini. Silakan pilih tanggal lain untuk memesan jadwal baru.')
                ->withInput();
        }
        // =============================================

        $jadwal = Jadwal::with('dokter')->findOrFail($request->jadwal_id);

        if ($jadwal->status !== 'Aktif') {
            return back()->with('error', 'Jadwal tidak aktif');
        }

        $jumlahBooking = PemesananJadwal::where('jadwal_id', $jadwal->id)
            ->where('tanggal', $request->tanggal)
            ->where('status', 'Menunggu')
            ->count();

        if ($jumlahBooking >= $jadwal->kuota_pasien) {
            return back()->with('error', 'Kuota penuh');
        }

        $lastNomorAntrian = PemesananJadwal::where('dokter_id', $jadwal->dokter_id)
            ->where('tanggal', $request->tanggal)
            ->max('nomor_antrian');

        $nomorAntrian = $lastNomorAntrian ? $lastNomorAntrian + 1 : 1;

        $booking = PemesananJadwal::create([
            'user_id'       => $user?->id,
            'dokter_id'     => $jadwal->dokter_id,
            'jadwal_id'     => $jadwal->id,
            'email'         => $email,
            'nama_pasien'   => $user?->name,
            'tanggal'       => $request->tanggal,
            'jam_mulai'     => $jadwal->jam_mulai,
            'jam_selesai'   => $jadwal->jam_selesai,
            'nomor_antrian' => $nomorAntrian,
            'keluhan'       => $request->keluhan,
            'status'        => 'Menunggu',
        ]);

        Antrian::create([
            'pemesanan_id'  => $booking->id,
            'nomor_antrian' => 'A' . str_pad($nomorAntrian, 3, '0', STR_PAD_LEFT),
            'status'        => 'menunggu',
        ]);

        return redirect()->route('pemesanan.berhasil', $booking->id);
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
            'booking'     => $booking,
            'userName'    => $user?->name ?? 'Pasien',
            'userRole'    => 'Pasien',
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
            return back()->with('error', 'Tidak bisa dibatalkan');
        }

        $booking->update([
            'status' => 'Dibatalkan'
        ]);

        return back()->with('success', 'Berhasil dibatalkan');
    }
}