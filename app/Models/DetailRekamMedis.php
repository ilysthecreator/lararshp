<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRekamMedis extends Model
{
    use HasFactory;

    protected $table = 'detail_rekam_medis';
    protected $primaryKey = 'iddetail_rekam_medis';

    // PENTING: Matikan timestamps karena tabel ini tidak punya kolom created_at/updated_at
    public $timestamps = false;

    protected $fillable = [
        'idrekam_medis',
        'idkode_tindakan_terapi',
        'detail' // Kolom ini menampung string gabungan (jumlah + keterangan)
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