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

    public function pemesanan()
    {
        return $this->belongsTo(PemesananJadwal::class, 'pemesanan_id');
    }
}