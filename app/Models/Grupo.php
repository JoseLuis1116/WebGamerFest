<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    // Definir la tabla si el nombre no sigue la convención plural
    protected $table = 'Grupos';

    // Definir las columnas que son asignables
    protected $fillable = [
        'nombre_equipo',
        'IDLider',
        'IDJuego',
        'estado',
        'numero_comprobante',
        'comprobante',
        'fecha_inscripcion',
        'fecha_pago',
    ];

    // Definir las relaciones

    // Un grupo tiene un líder (relación con el modelo Usuario)
    public function lider()
    {
        return $this->belongsTo(Usuario::class, 'IDLider');
    }

    // Un grupo pertenece a un juego (relación con el modelo Juego)
    public function juego()
    {
        return $this->belongsTo(Juego::class, 'IDJuego');
    }
}
