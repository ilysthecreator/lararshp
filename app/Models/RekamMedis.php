<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';

    // PENTING: Matikan timestamps otomatis agar Laravel tidak mencari kolom 'updated_at'
    public $timestamps = false;

    protected $fillable = [
        'idreservasi_dokter',
        'dokter_pemeriksa',
        'anamnesa',
        'diagnosa',
        'temuan_klinis',
        'created_at' // Kita isi manual di controller
    ];

    public function temuDokter()
    {
        return $this->belongsTo(TemuDokter::class, 'idreservasi_dokter', 'idreservasi_dokter');
    }

    public function pet()
    {
        return $this->hasOneThrough(Pet::class, TemuDokter::class, 'idreservasi_dokter', 'idpet', 'idreservasi_dokter', 'idpet');
    }

    public function dokter()
    {
        return $this->belongsTo(RoleUser::class, 'dokter_pemeriksa', 'idrole_user');
    }

    public function detailRekamMedis()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }
}