<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisHewan extends Model
{
    use HasFactory;

    protected $table = 'jenis_hewan'; // Sesuaikan dengan nama tabel di database
    
    protected $fillable = [
        'nama_jenis',
        'deskripsi',
    ];

    // Relasi dengan RasHewan (jika ada)
    public function rasHewan()
    {
        return $this->hasMany(RasHewan::class, 'jenis_hewan_id');
    }

    // Relasi dengan Pet (jika ada)
    public function pets()
    {
        return $this->hasMany(Pet::class, 'jenis_hewan_id');
    }
}