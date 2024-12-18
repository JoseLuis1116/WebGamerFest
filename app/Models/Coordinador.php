<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinador extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'Coordinadores';

    // Llave primaria
    protected $primaryKey = 'IDCoordinador';

    // Campos que pueden ser llenados de manera masiva
    protected $fillable = [
        'IDRol',
        'IDJuego',
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

    public function juego()
    {
        return $this->belongsTo(Juego::class, 'IDJuego', 'IDJuego');
    }
}
