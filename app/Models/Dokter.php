<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jadwal;

// Model untuk tabel 'dokters'
class Dokter extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'nama',
        'str',
        'no_hp',
        'status',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi: Dokter memiliki banyak Jadwal
    public function jadwals()
    {
        // Relasi one-to-many: Satu dokter bisa punya banyak jadwal
        return $this->hasMany(Jadwal::class);
    }
}
