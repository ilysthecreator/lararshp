<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;

    protected $table = 'role_user';
    protected $primaryKey = 'idrole_user';
    protected $fillable = [
        'idrole_user',
        'iduser',
        'idrole',
        'status'
    ];

    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }
}