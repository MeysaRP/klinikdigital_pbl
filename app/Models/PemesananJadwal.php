<?php

namespace App\Models;

use Carbon\Carbon;
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

    protected $appends = [
        'slot_mulai',
        'slot_selesai',
    ];

    public function getSlotMulaiAttribute()
    {
        if (! $this->jam_mulai || ! $this->nomor_antrian) {
            return null;
        }

        $offsetMinutes = max(0, ((int) $this->nomor_antrian - 1) * 15);

        return Carbon::parse($this->jam_mulai)
            ->addMinutes($offsetMinutes)
            ->format('H:i');
    }

    public function getSlotSelesaiAttribute()
    {
        if (! $this->slot_mulai) {
            return null;
        }

        return Carbon::parse($this->slot_mulai)
            ->addMinutes(15)
            ->format('H:i');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
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