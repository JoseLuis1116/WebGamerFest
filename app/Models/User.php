<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use HasFactory, TwoFactorAuthenticatable;

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
        'two_factor_recovery_codes', // Ocultar códigos de recuperación
        'two_factor_secret',        // Ocultar la clave secreta 2FA
    ];

    // Si necesitas atributos adicionales o relaciones, puedes agregarlas aquí
}
