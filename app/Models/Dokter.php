<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jadwal;

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

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}
