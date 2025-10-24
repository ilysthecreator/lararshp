<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role';
    
    protected $fillable = [
        'nama_role',
        'deskripsi',
    ];

    // Relasi dengan User (jika menggunakan tabel pivot role_user)
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}