<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemuDokter extends Model
{
    use HasFactory;

    protected $table = 'temu_dokter';
    protected $primaryKey = 'idreservasi_dokter'; // Sesuai DB
    public $timestamps = false; // DB tidak punya created_at/updated_at di tabel ini

    protected $fillable = [
        'idpet',
        'idrole_user', // Pengganti dokter_id
        'waktu_daftar', // Pengganti tgl_temu & jam_temu
        'no_urut',
        'status',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    // Relasi ke Dokter via tabel role_user
    public function dokterRoleUser()
    {
        return $this->belongsTo(RoleUser::class, 'idrole_user', 'idrole_user');
    }
}