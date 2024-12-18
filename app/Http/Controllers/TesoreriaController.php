<?php

namespace App\Http\Controllers;

use App\Models\Tesoreria;
use Illuminate\Http\Request;

class TesoreriaController extends Controller
{
    /**
     * Mostrar una lista de registros de tesorería.
     */
    public function index()
    {
        $tesoreria = Tesoreria::with('rol')->get();
        return response()->json($tesoreria);
    }

    /**
     * Crear un nuevo registro en tesorería.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'IDRol' => 'required|exists:Roles,IDRol',
            'Nombres' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
            'Celular' => 'required|string|max:20',
            'CorreoElectronico' => 'required|email|unique:Tesoreria,CorreoElectronico',
            'Contrasenia' => 'required|string|min:8',
        ]);

        $tesoreria = Tesoreria::create($validatedData);
        return response()->json($tesoreria, 201);
    }

    /**
     * Mostrar un registro específico de tesorería.
     */
    public function show($id)
    {
        $tesoreria = Tesoreria::with('rol')->findOrFail($id);
        return response()->json($tesoreria);
    }

    /**
     * Actualizar un registro de tesorería.
     */
    public function update(Request $request, $id)
    {
        $tesoreria = Tesoreria::findOrFail($id);

        $validatedData = $request->validate([
            'IDRol' => 'sometimes|exists:Roles,IDRol',
            'Nombres' => 'sometimes|string|max:255',
            'Apellidos' => 'sometimes|string|max:255',
            'Celular' => 'sometimes|string|max:20',
            'CorreoElectronico' => 'sometimes|email|unique:Tesoreria,CorreoElectronico,' . $id . ',IDTesoreria',
            'Contrasenia' => 'sometimes|string|min:8',
        ]);

        $tesoreria->update($validatedData);
        return response()->json($tesoreria);
    }

    /**
     * Eliminar un registro de tesorería.
     */
    public function destroy($id)
    {
        $tesoreria = Tesoreria::findOrFail($id);
        $tesoreria->delete();
        return response()->json(['message' => 'Registro eliminado correctamente']);
    }
}
