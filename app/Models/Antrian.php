<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $fillable = [
        'pemesanan_id',
        'nomor_antrian',
        'status',
        'waktu_panggil',
    ];

    // Relasi dengan model PemesananJadwal
    public function pemesanan()
    {
        // Relasi many-to-one: Banyak antrian bisa untuk satu pemesanan jadwal
        return $this->belongsTo(PemesananJadwal::class, 'pemesanan_id');
    }

    // Relasi dengan model RekamMedis
    public function rekamMedis()
    {
        // Relasi one-to-one: Satu antrian bisa punya satu rekam medis
        return $this->hasOne(RekamMedis::class);
    }
}