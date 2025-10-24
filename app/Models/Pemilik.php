<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;

    protected $table = 'pemilik';
    
    protected $fillable = [
        'nama_pemilik',
        'alamat',
        'no_telepon',
        'email',
    ];

    // Relasi dengan Pet
    public function pets()
    {
        return $this->hasMany(Pet::class, 'pemilik_id');
    }
}