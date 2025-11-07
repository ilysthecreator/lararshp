<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'iduser';

    protected $fillable = [ 'nama', 'email', 'password' ];
    protected $hidden = [ 'password', 'remember_token' ];
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
    public function roleUser()
    {
        return $this->hasMany(RoleUser::class, 'iduser', 'iduser');
    }
    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }
}