<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';

    protected $fillable = [
        'antrian_id',
        'diagnosa',
        'catatan_dokter',
        'resep_obat', // <--- TAMBAHKAN INI
    ];
    
    protected $casts = [
        'resep_obat' => 'array', 
    ];
}