<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'alamat',
        'tgl_lahir',
        'jk',
        'no_hp',
        'no_str',     
        'status',     
        'kategori',
        'no_identitas',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // FUNGSI BARU: Auto nambahin "Dr. " untuk role dokter
    public function getNameAttribute($value)
    {
        // Kalau role-nya dokter dan namanya belum diawali "Dr. ", tambahkan
        if ($this->role === 'dokter' && !str_starts_with($value, 'Dr. ')) {
            return 'Dr. ' . $value;
        }
        
        // Kalau bukan dokter, atau sudah ada "Dr. "-nya, kembalikan nama aslinya
        return $value;
    }
}