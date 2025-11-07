<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
   protected $table = 'role';
    protected $primaryKey = 'idrole';
    public function roleUsers()
    {
        return $this->hasMany(RoleUser::class, 'idrole', 'idrole');
    }

    public function users()
    {
        return $this->hasManyThrough(
            User::class,
            RoleUser::class,
            'idrole',
            'iduser',
            'idrole',
            'iduser'
        );
    }
}