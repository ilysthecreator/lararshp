<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRekamMedis extends Model
{
    use HasFactory;

    protected $table = 'detail_rekam_medis';
    protected $primaryKey = 'iddetail_rekam_medis';

    protected $fillable = [
        'idrekam_medis',
        'idkode_tindakan_terapi',
        'jumlah',
        'keterangan',
    ];

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }

    public function kodeTindakan()
    {
        return $this->belongsTo(KodeTindakan::class, 'idkode_tindakan_terapi', 'idkode_tindakan_terapi');
    }
}