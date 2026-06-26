<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jadwal;

// Model untuk tabel 'dokters'
class Dokter extends Model
{
    // Gunakan trait HasFactory untuk mendukung pembuatan instance model menggunakan factory
    use HasFactory;
    
    // Tentukan nama tabel yang digunakan
    protected $fillable = [
        'email',
        'nama',
        'str',
        'no_hp',
        'status',
        'password',
    ];
    // Tentukan atribut yang harus disembunyikan saat model dikonversi ke array atau JSON
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
