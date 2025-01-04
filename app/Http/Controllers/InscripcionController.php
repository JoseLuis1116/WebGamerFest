<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InscripcionController extends Controller
{
    public function create()
    {
        return view('usuarios.participantes.participantes'); // Ajusta la vista según tu estructura
    }
    public function store(Request $request)
    {
        try {
            // Validar los datos
            $validated = $request->validate([
                'IDUsuario' => 'required|exists:usuarios,id', // Verifica que esta tabla y columna existan
                'IDJuego' => 'required|exists:juegos,IDJuego', // Verifica que esta tabla y columna existan
                'FechaInscripcion' => 'required|date',
                'Monto' => 'required|numeric',
                'ComprobantePago' => 'nullable|image',
            ]);


            Log::info('Datos validados:', $validated);

            // Procesar archivo si se envió
            if ($request->hasFile('ComprobantePago')) {
                $validated['ComprobantePago'] = $request->file('ComprobantePago')->store('comprobantes', 'public');
                Log::info('Archivo guardado:', ['path' => $validated['ComprobantePago']]);
            }

            // Crear inscripción en la base de datos
            Inscripcion::create($validated);

            Log::info('Inscripción registrada con éxito.');
            return response()->json(['message' => 'Inscripción registrada con éxito'], 200);
        } catch (\Exception $e) {
            Log::error('Error al registrar inscripción:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Error al registrar inscripción', 'error' => $e->getMessage()], 500);
        }
    }
}
