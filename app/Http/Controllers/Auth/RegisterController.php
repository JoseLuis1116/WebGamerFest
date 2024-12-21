<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Muestra el formulario de registro.
     */
    public function create()
    {
        return view('auth.register'); // Ajusta si la vista tiene otro nombre o ubicación
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // Obtener el rol "Participante" (predeterminado)
        $rolParticipante = Role::where('NombreRol', 'Participante')->first();

        // Crear el usuario en la tabla 'users'
        Usuario::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'IDRol' => $rolParticipante->IDRol, // Asigna el rol "Participante"
        ]);

        return redirect()->route('login')->with('success', 'Usuario registrado correctamente.');
    }
}
