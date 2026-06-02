<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasiens'; // optional tapi aman

    protected $fillable = [
        'nama',
        'no_hp',
        'tgl_lahir',
        'jk',
        'alamat'
    ];
}