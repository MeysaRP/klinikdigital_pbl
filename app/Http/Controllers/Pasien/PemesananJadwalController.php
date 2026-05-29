<?php
namespace App\Http\Controllers\Pasien;
use App\Http\Controllers\Controller;

class PemesananJadwalController extends Controller
{
    public function index() { return view('pages.pasien.pemesanan_jadwal'); }
    public function proses() { return redirect()->route('pemesanan.berhasil', ['nomor_antrian' => sprintf("%02d", rand(1, 99))]); }
    public function berhasil($nomor_antrian) { return view('pages.pasien.pemesanan_berhasil', compact('nomor_antrian')); }
}