<?php

namespace App\Models; // Define el namespace correcto

use Illuminate\Database\Eloquent\Model; // Importa la clase base Model
use Illuminate\Database\Eloquent\Factories\HasFactory; // Opcional, para usar factories
use App\Models\Role; // Importa el modelo Role si es necesario


class Participante extends Model
{
    protected $table = 'Participantes';
    protected $primaryKey = 'IDParticipante';

    // Campos que se pueden llenar
    protected $fillable = [
        'IDParticipante',
        'IDRol',
        'Nombres',
        'Apellidos',
        'Celular',
        'Universidad',
        'CorreoElectronico',
        'Contrasenia',
    ];

    // Desactiva timestamps si no existen en la tabla
    public $timestamps = false;
}
