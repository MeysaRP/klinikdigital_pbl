<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PemesananJadwal;
use App\Models\Dokter;

class Jadwal extends Model
{
    protected $table = 'jadwals';

    protected $fillable = [
        'dokter_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'kuota_pasien',
        'status',
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    public function pemesanan()
    {
        return $this->hasMany(PemesananJadwal::class, 'jadwal_id');
    }
}