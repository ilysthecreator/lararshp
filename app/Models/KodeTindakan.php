<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeTindakan extends Model
{
    use HasFactory;

    protected $table = 'kode_tindakan';
    
    protected $fillable = [
        'kode',
        'nama_tindakan',
        'deskripsi',
        'tarif',
    ];
}