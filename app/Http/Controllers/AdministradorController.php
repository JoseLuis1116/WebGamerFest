<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    /**
     * Mostrar una lista de administradores.
     */
    public function index()
    {
        $administradores = Administrador::with('rol')->get();
        return response()->json($administradores);
    }

    /**
     * Crear un nuevo administrador.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'IDRol' => 'required|exists:Roles,IDRol',
            'Nombres' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
            'Celular' => 'required|string|max:20',
            'CorreoElectronico' => 'required|email|unique:Administrador,CorreoElectronico',
            'Contrasenia' => 'required|string|min:8',
        ]);

        $administrador = Administrador::create($validatedData);
        return response()->json($administrador, 201);
    }

    /**
     * Mostrar un administrador específico.
     */
    public function show($id)
    {
        $administrador = Administrador::with('rol')->findOrFail($id);
        return response()->json($administrador);
    }

    /**
     * Actualizar un administrador.
     */
    public function update(Request $request, $id)
    {
        $administrador = Administrador::findOrFail($id);

        $validatedData = $request->validate([
            'IDRol' => 'sometimes|exists:Roles,IDRol',
            'Nombres' => 'sometimes|string|max:255',
            'Apellidos' => 'sometimes|string|max:255',
            'Celular' => 'sometimes|string|max:20',
            'CorreoElectronico' => 'sometimes|email|unique:Administrador,CorreoElectronico,' . $id . ',IDAdministrador',
            'Contrasenia' => 'sometimes|string|min:8',
        ]);

        $administrador->update($validatedData);
        return response()->json($administrador);
    }

    /**
     * Eliminar un administrador.
     */
    public function destroy($id)
    {
        $administrador = Administrador::findOrFail($id);
        $administrador->delete();
        return response()->json(['message' => 'Administrador eliminado correctamente']);
    }
}
