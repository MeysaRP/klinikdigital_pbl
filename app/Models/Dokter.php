<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'nama',
        'str',
        'no_hp',
        'status',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
