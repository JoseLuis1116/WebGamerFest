<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tesoreria extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'Tesoreria';

    // Llave primaria
    protected $primaryKey = 'IDTesoreria';

    // Campos que pueden ser llenados de manera masiva
    protected $fillable = [
        'IDRol',
        'Nombres',
        'Apellidos',
        'Celular',
        'CorreoElectronico',
        'Contrasenia',
    ];

    // Relaciones
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'IDRol', 'IDRol');
    }
}
