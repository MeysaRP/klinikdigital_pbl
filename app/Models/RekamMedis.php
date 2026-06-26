<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    // Tentukan nama tabel yang digunakan
    protected $table = 'rekam_medis';

    // Tentukan atribut yang dapat diisi secara massal
    protected $fillable = [
        'antrian_id',
        'diagnosa',
        'catatan_dokter',
        'resep_obat',
    ];
    // Tentukan atribut yang harus dikonversi ke tipe data tertentu
    protected $casts = [
        'resep_obat' => 'array', 
    ];
}