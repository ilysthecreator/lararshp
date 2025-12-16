<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    
    // TAMBAHKAN INI: Matikan timestamps karena tabel pet tidak punya created_at & updated_at
    public $timestamps = false;

    // SESUAIKAN DENGAN DATABASE (rshplara.sql)
    protected $fillable = [
        'idpemilik',
        'idras_hewan',
        'nama',            // Di model lama: nama_pet (Salah)
        'jenis_kelamin',
        'tanggal_lahir',   // Di model lama: tgl_lahir (Salah)
        'warna_tanda',     // Di model lama: warna_bulu (Salah)
    ];

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }
    
    public function jenisHewan() 
    {
        return $this->hasOneThrough(JenisHewan::class, RasHewan::class, 'idras_hewan', 'idjenis_hewan', 'idras_hewan', 'idjenis_hewan');
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