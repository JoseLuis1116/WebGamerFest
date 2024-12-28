<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    use HasFactory;

    protected $table = 'juegos';

    protected $fillable = [
        'NombreJuego',
        'DescripcionJuego',
        'IDCategoria',
        'IDModalidad',
        'ImagenJuego',
    ];

    // Relación con Categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'IDCategoria');
    }

    // Relación con Modalidad
    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class, 'IDModalidad');
    }
}
