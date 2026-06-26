<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PemesananJadwal;
use App\Models\Dokter;

// Model untuk tabel 'jadwals'
class Jadwal extends Model
{
    // Tentukan nama tabel yang digunakan
    protected $table = 'jadwals';
    
    // Tentukan atribut yang dapat diisi secara massal
    protected $fillable = [
        'dokter_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'kuota_pasien',
        'status',
    ];

    // Relasi dengan model Dokter
    public function dokter()
    {
        // Relasi many-to-one: Banyak jadwal bisa untuk satu dokter
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    // Relasi dengan model PemesananJadwal
    public function pemesanan()
    {
        // Relasi one-to-many: Satu jadwal bisa punya banyak pemesanan
        return $this->hasMany(PemesananJadwal::class, 'jadwal_id');
    }
}