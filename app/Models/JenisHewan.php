<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisHewan extends Model
{
    use HasFactory;

    protected $table = 'jenis_hewan';   
    protected $primaryKey = 'idjenis_hewan';
    
    protected $fillable = [
        'nama_jenis_hewan',
    ];

    public $timestamps = false;

    public function rasHewan()
    {
        return $this->hasMany(RasHewan::class, 'idjenis_hewan', 'idjenis_hewan');
    }
    
    public function pets()
    {
        return $this->hasManyThrough(
            Pet::class,
            RasHewan::class,
            'idjenis_hewan', // Foreign key on ras_hewan table...
            'idras_hewan'    // Foreign key on pets table...
        );
    }
}