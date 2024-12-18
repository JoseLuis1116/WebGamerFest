<?php

namespace App\Http\Controllers;

use App\Models\Coordinador;
use Illuminate\Http\Request;

class CoordinadorController extends Controller
{
    /**
     * Mostrar una lista de coordinadores.
     */
    public function index()
    {
        $coordinadores = Coordinador::with(['rol', 'juego'])->get();
        return response()->json($coordinadores);
    }

    /**
     * Crear un nuevo coordinador.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'IDRol' => 'required|exists:Roles,IDRol',
            'IDJuego' => 'required|exists:Juegos,IDJuego',
            'Nombres' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
            'Celular' => 'required|string|max:20',
            'CorreoElectronico' => 'required|email|unique:Coordinadores,CorreoElectronico',
            'Contrasenia' => 'required|string|min:8',
        ]);

        $coordinador = Coordinador::create($validatedData);
        return response()->json($coordinador, 201);
    }

    /**
     * Mostrar un coordinador específico.
     */
    public function show($id)
    {
        $coordinador = Coordinador::with(['rol', 'juego'])->findOrFail($id);
        return response()->json($coordinador);
    }

    /**
     * Actualizar un coordinador.
     */
    public function update(Request $request, $id)
    {
        $coordinador = Coordinador::findOrFail($id);

        $validatedData = $request->validate([
            'IDRol' => 'sometimes|exists:Roles,IDRol',
            'IDJuego' => 'sometimes|exists:Juegos,IDJuego',
            'Nombres' => 'sometimes|string|max:255',
            'Apellidos' => 'sometimes|string|max:255',
            'Celular' => 'sometimes|string|max:20',
            'CorreoElectronico' => 'sometimes|email|unique:Coordinadores,CorreoElectronico,' . $id . ',IDCoordinador',
            'Contrasenia' => 'sometimes|string|min:8',
        ]);

        $coordinador->update($validatedData);
        return response()->json($coordinador);
    }

    /**
     * Eliminar un coordinador.
     */
    public function destroy($id)
    {
        $coordinador = Coordinador::findOrFail($id);
        $coordinador->delete();
        return response()->json(['message' => 'Coordinador eliminado correctamente']);
    }
}
