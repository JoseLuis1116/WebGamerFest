<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoordinadorJuego extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada
    protected $table = 'coordinadores_juegos';

    // Campos que pueden ser asignados de manera masiva
    protected $fillable = [
        'IDCoordinador',
        'IDJuego',
    ];

    /**
     * Relación con el modelo Usuario (Coordinador).
     * Un registro de la tabla Coordinadores_Juegos pertenece a un coordinador.
     */
    public function coordinador()
    {
        return $this->belongsTo(Usuario::class, 'IDCoordinador', 'id');
    }

    /**
     * Relación con el modelo Juego.
     * Un registro de la tabla Coordinadores_Juegos pertenece a un juego.
     */
    public function juego()
    {
        return $this->belongsTo(Juego::class, 'IDJuego', 'IDJuego');
    }
}
