<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemuDokter extends Model
{
    use HasFactory;

    protected $table = 'temu_dokter';
    protected $primaryKey = 'idtemu_dokter';

    protected $fillable = [
        'idpet',
        'iddokter',
        'tgl_temu',
        'jam_temu',
        'keluhan',
        'status',
    ];

    public $timestamps = false;

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'iddokter', 'iddokter');
    }
}