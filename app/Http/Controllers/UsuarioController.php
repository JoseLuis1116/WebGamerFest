<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Role; // Asegúrate de que este modelo exista para manejar los roles

class UsuarioController extends Controller
{
    /**
     * Muestra el formulario de registro.
     */
    public function create()
    {
        return view('auth.register'); // Asegúrate de que esta vista exista en resources/views/auth/register.blade.php
    }

    /**
     * Almacena un nuevo registro en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'Nombres' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
            'Celular' => 'required|digits:10',
            'Universidad' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email', // Verificar que el email sea único
            'Contrasenia' => 'required|min:8|confirmed', // Confirmar contraseña
        ]);

        // Buscar el ID del rol de "Participante"
        $rolParticipante = Role::where('NombreRol', 'Participante')->first();

        // Si el rol no existe, redirigir con error
        if (!$rolParticipante) {
            return redirect()->back()->withErrors(['error' => 'El rol de "Participante" no existe. Verifica la tabla roles.']);
        }

        // Crear el usuario y asignar el rol de "Participante"
        $usuario = Usuario::create([
            'name' => $request->Nombres . ' ' . $request->Apellidos,
            'email' => $request->email,
            'password' => bcrypt($request->Contrasenia), // Encriptar la contraseña
            'Celular' => $request->Celular,
            'Universidad' => $request->Universidad,
            'IDRol' => $rolParticipante->IDRol, // Asignar el rol de participante
        ]);

        // Redirigir con éxito o error
        if ($usuario) {
            return redirect()->route('register')->with('success', '¡Usuario registrado correctamente con el rol de Participante!');
        } else {
            return redirect()->back()->withErrors(['error' => 'Hubo un problema al registrar el usuario.']);
        }
    }
}
