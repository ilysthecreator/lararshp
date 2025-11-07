<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    /**
     * Nama tabel yang terhubung [cite: 117]
     */
    protected $table = 'pemilik';

    /**
     * Primary key kustom [cite: 119]
     */
    protected $primaryKey = 'idpemilik';

    /**
     * Kolom yang dapat diisi [cite: 121]
     * (Kita biarkan sesuai modul, meskipun view kita read-only)
     */
    protected $fillable = ['no_wa', 'alamat'];

    /**
     * Definisikan relasi "belongsTo" ke User [cite: 124-128]
     * Ini PENTING agar 'pemilik.user' di controller Anda berfungsi.
     */
    public function user()
    {
        // belongsTo(Model, foreign_key, owner_key)
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
}