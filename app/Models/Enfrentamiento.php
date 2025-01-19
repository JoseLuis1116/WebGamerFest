<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfrentamiento extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada
    protected $table = 'enfrentamientos';

    // Clave primaria personalizada
    protected $primaryKey = 'idEnfrentamiento';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'IDJuego',
        'participante1',
        'participante2',
        'ronda',
        'fecha',
        'estado',
        'resultado'
    ];

    // Tipos de datos para los campos
    protected $casts = [
        'fecha' => 'datetime',
        'estado' => 'string',
        'ronda' => 'string',
    ];

    /**
     * Relación con el modelo Juego (Muchos a Uno)
     */
    public function juego()
    {
        return $this->belongsTo(Juego::class, 'IDJuego', 'IDJuego');
    }

    /**
     * Relación con el modelo Usuario (Uno a Muchos Inverso) para participante1
     */
    public function participanteUno()
    {
        return $this->belongsTo(Usuario::class, 'participante1', 'id');
    }

    /**
     * Relación con el modelo Usuario (Uno a Muchos Inverso) para participante2
     */
    public function participanteDos()
    {
        return $this->belongsTo(Usuario::class, 'participante2', 'id');
    }
}
