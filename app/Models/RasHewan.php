<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RasHewan extends Model
{
    use HasFactory;

    protected $table = 'ras_hewan';
    
    protected $fillable = [
        'jenis_hewan_id',
        'nama_ras',
        'deskripsi',
    ];

    // Relasi dengan JenisHewan
    public function jenisHewan()
    {
        return $this->belongsTo(JenisHewan::class, 'jenis_hewan_id');
    }

    // Relasi dengan Pet
    public function pets()
    {
        return $this->hasMany(Pet::class, 'ras_hewan_id');
    }
}