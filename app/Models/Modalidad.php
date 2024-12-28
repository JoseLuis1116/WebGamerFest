<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada al modelo.
     */
    protected $table = 'modalidades'; // Nombre de la tabla en la base de datos

    /**
     * Nombre de la clave primaria de la tabla.
     */
    protected $primaryKey = 'IDModalidad'; // Cambia esto si la clave primaria tiene otro nombre

    /**
     * Indica si la clave primaria es autoincremental.
     */
    public $incrementing = true;

    /**
     * Tipo de la clave primaria.
     */
    protected $keyType = 'int';

    /**
     * Los atributos que se pueden asignar de forma masiva.
     */
    protected $fillable = [
        'TipoModalidad', // Incluye aquí los campos que deseas permitir para asignación masiva
    ];

    /**
     * Relación con la tabla Juegos.
     * Una modalidad puede estar asociada a muchos juegos.
     */
    public function juegos()
    {
        return $this->hasMany(Juego::class, 'IDModalidad', 'IDModalidad');
    }
}
