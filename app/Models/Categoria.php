<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada al modelo.
     */
    protected $table = 'categorias'; // Asegúrate de que este sea el nombre correcto de tu tabla en la base de datos.

    /**
     * Nombre de la clave primaria de la tabla.
     */
    protected $primaryKey = 'IDCategoria'; // Cambia esto si tu clave primaria tiene otro nombre.

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
        'TipoCategoria', // Incluye los campos que quieres permitir para la asignación masiva.
    ];

    /**
     * Relación con la tabla Juegos.
     * Una categoría puede tener muchos juegos.
     */
    public function juegos()
    {
        return $this->hasMany(Juego::class, 'IDCategoria', 'IDCategoria');
    }
}
