<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'idpet';

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }
    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'idpet', 'idpet');
    }
}