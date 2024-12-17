<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Participante;

class UsuarioController extends Controller
{
    /**
     * Almacena un nuevo registro en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. VALIDAR LOS DATOS DEL FORMULARIO
        $request->validate([
            'Nombres' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
            'Celular' => 'required|digits:10',
            'Universidad' => 'required|string|max:255',
            'CorreoElectronico' => 'required|email|unique:Usuarios,CorreoElectronico',
            'Contrasenia' => 'required|min:8|confirmed', // Confirmar contraseña
        ]);

        // 2. GUARDAR EL REGISTRO EN LA TABLA USUARIOS
        $usuario = Usuario::create([
            'Nombres' => $request->Nombres,
            'Apellidos' => $request->Apellidos,
            'Celular' => $request->Celular,
            'Universidad' => $request->Universidad,
            'CorreoElectronico' => $request->CorreoElectronico,
            'Contrasenia' => bcrypt($request->Contrasenia), // Encriptar contraseña
            'IDRol' => 2, // Asignar un rol predeterminado
        ]);

        // 3. REGISTRAR AUTOMÁTICAMENTE EN LA TABLA PARTICIPANTES
        Participante::create([
            'Nombres' => $usuario->Nombres,
            'Apellidos' => $usuario->Apellidos,
            'Celular' => $usuario->Celular,
            'Universidad' => $usuario->Universidad,
            'CorreoElectronico' => $usuario->CorreoElectronico,
            'Contrasenia' => $usuario->Contrasenia, // Contraseña ya encriptada
            'IDRol' => $usuario->IDRol, // Mismo rol que el usuario
        ]);

        // 4. REDIRECCIONAR A UNA VISTA CON MENSAJE DE ÉXITO
        return redirect()->back()->with('success', 'Usuario registrado correctamente.');
    }
}

