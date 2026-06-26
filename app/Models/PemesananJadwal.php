<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dokter;

// Model untuk tabel 'pemesanan_jadwals'
class PemesananJadwal extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan oleh model ini
    protected $table = 'pemesanan_jadwals';

    // Menentukan kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'user_id',
        'dokter_id',
        'jadwal_id',
        'email',
        'nama_pasien',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'nomor_antrian',
        'keluhan',
        'status',
    ];

    // Menentukan atribut tambahan yang akan ditambahkan ke model saat diambil dari database
    protected $appends = [
        'slot_mulai',
        'slot_selesai',
    ];

    // Aksesor untuk menghitung slot mulai berdasarkan jam_mulai dan nomor_antrian
    public function getSlotMulaiAttribute()
    {
        // Jika jam_mulai atau nomor_antrian tidak ada, kembalikan null
        if (! $this->jam_mulai || ! $this->nomor_antrian) {
            return null;
        }

        // Setiap pasien mendapat slot 15 menit, jadi kita hitung offset berdasarkan nomor antrian
        $offsetMinutes = max(0, ((int) $this->nomor_antrian - 1) * 15);

        // Hitung slot mulai dengan menambahkan offset ke jam_mulai
        return Carbon::parse($this->jam_mulai)
            ->addMinutes($offsetMinutes)
            ->format('H:i');
    }

    // Aksesor untuk menghitung slot selesai berdasarkan slot_mulai
    public function getSlotSelesaiAttribute()
    {   
        // Jika slot_mulai tidak ada, kembalikan null
        if (! $this->slot_mulai) {
            return null;
        }

        // Slot selesai adalah 15 menit setelah slot mulai
        return Carbon::parse($this->slot_mulai)
            ->addMinutes(15)
            ->format('H:i');
    }

    // Relasi dengan model Dokter
    public function dokter()
    {
        // Relasi many-to-one: Banyak pemesanan bisa untuk satu dokter
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    // Relasi dengan model Jadwal
    public function jadwal()
    {
        // Relasi many-to-one: Banyak pemesanan bisa untuk satu jadwal
        return $this->belongsTo(Jadwal::class);
    }

    // Relasi dengan model User
    public function user()
    {
        // Relasi many-to-one: Banyak pemesanan bisa untuk satu user
        return $this->belongsTo(User::class);
    }

    // Relasi dengan model Antrian
    public function antrian()
    {
        // Relasi one-to-one: Satu pemesanan punya satu antrian
        return $this->hasOne(Antrian::class, 'pemesanan_id');
    }
}