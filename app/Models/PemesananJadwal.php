<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananJadwal extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_jadwals';

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

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function antrian()
    {
        return $this->hasOne(Antrian::class, 'pemesanan_id');
    }
}
