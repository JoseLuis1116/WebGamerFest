<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntegranteGrupo extends Model
{
    use HasFactory;

    // Definir la tabla si el nombre no sigue la convención plural
    protected $table = 'integrantes_grupo';

    // Definir las columnas que son asignables
    protected $fillable = [
        'id_grupo',
        'id_usuario',
    ];

    // Definir las relaciones

    // Un integrante pertenece a un grupo (relación con el modelo Grupo)
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }

    // Un integrante pertenece a un usuario (relación con el modelo Usuario)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
