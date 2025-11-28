<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKlinis extends Model
{
    use HasFactory;

    protected $table = 'kategori_klinis';
    protected $primaryKey = 'idkategori_klinis';

    protected $fillable = [
        'nama_kategori_klinis',
    ];

    public function kodeTindakan()
    {
        return $this->hasMany(KodeTindakan::class, 'idkategori_klinis', 'idkategori_klinis');
    }
}