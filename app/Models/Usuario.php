<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    use HasFactory;

    // Nombre correcto de la tabla en la base de datos
    protected $table = 'usuarios'; 
    protected $primaryKey = 'id'; // Clave primaria personalizada

    // Campos que se pueden llenar de forma masiva
    protected $fillable = [
        'name',            // Nombre completo
        'email',           // Correo electrónico
        'password',        // Contraseña encriptada
        'Celular',         // Celular del usuario
        'Universidad',     // Universidad del usuario
        'IDRol',           // ID del rol asignado
    ];

    /**
     * Relación con el modelo Role (opcional si tienes la tabla roles).
     */
    public function rol()
    {
        return $this->belongsTo(Role::class, 'IDRol', 'IDRol');
    }
}
