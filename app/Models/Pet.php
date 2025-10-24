<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $table = 'pet';
    
    protected $fillable = [
        'name',
        'species',
        'breed',
        'date_of_birth',
        'gender',
        'description',
        'user_id',
    ];

    /**
     * Get the user that owns the pet.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}