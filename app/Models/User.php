<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'name',
        'email',
        'password',
        'Celular',
        'Universidad',
        'IDRol',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
