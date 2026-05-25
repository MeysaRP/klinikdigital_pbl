<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    // RELASI ke dokter
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}