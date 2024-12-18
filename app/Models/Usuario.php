<?php

namespace App\Models; // Define el namespace correctamente

use Illuminate\Database\Eloquent\Model; // Importa la clase base Model
use Illuminate\Database\Eloquent\Factories\HasFactory; // Opcional, si usas factories
use App\Models\Participante; // Importa el modelo Participante
use App\Models\Role; // Importa el modelo Role si es necesario



class Usuario extends Model
{
    protected $table = 'Usuarios';
    protected $primaryKey = 'IDUsuario';

    protected $fillable = [
        'Nombres',
        'Apellidos',
        'Universidad',
        'Celular',
        'CorreoElectronico',
        'Contrasenia',
        'IDRol',
    ];

    protected static function booted()
    {
        static::created(function ($usuario) {
            // Validar si ya existe un participante con el mismo correo
            $existeParticipante = Participante::where('CorreoElectronico', $usuario->CorreoElectronico)->exists();

            if (!$existeParticipante) {
                Participante::create([
                    'IDParticipante' => $usuario->IDUsuario,
                    'IDRol' => $usuario->IDRol,
                    'Nombres' => $usuario->Nombres,
                    'Apellidos' => $usuario->Apellidos,
                    'Celular' => $usuario->Celular,
                    'Universidad' => $usuario->Universidad,
                    'CorreoElectronico' => $usuario->CorreoElectronico,
                    'Contrasenia' => $usuario->Contrasenia,
                ]);
            }
        });
    }
}
