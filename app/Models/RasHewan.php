<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RasHewan extends Model
{
    use HasFactory;

    protected $table = 'ras_hewan';
    protected $primaryKey = 'idras_hewan';
    
    protected $fillable = [
        'idjenis_hewan',
        'nama_ras',
    ];

    public $timestamps = false;

    public function jenisHewan()
    {
        return $this->belongsTo(JenisHewan::class, 'idjenis_hewan', 'idjenis_hewan');
    }

    public function pets()
    {
        return $this->hasMany(Pet::class, 'idras_hewan', 'idras_hewan');
    }
}