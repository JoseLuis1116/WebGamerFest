<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rol;

class Administrador extends Model
{
    // Tabla asociada
    protected $table = 'Administrador';

    // Clave primaria
    protected $primaryKey = 'IDAdministrador';

    // Campos que se pueden llenar
    protected $fillable = [
        'IDAdministrador',
        'IDRol',
        'Nombres',
        'Apellidos',
        'Celular',
        'CorreoElectronico',
        'Contrasenia',
    ];

    // Desactiva timestamps si no existen en la tabla
    public $timestamps = false;

    /**
     * Relación con la tabla Roles.
     * Un administrador pertenece a un rol específico.
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'IDRol', 'IDRol');
    }
}
