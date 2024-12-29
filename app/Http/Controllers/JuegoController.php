<?php

namespace App\Http\Controllers;

use App\Models\Juego;
use App\Models\Categoria;
use App\Models\Modalidad;
use Illuminate\Http\Request;

class JuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $juegos = Juego::with(['categoria', 'modalidad'])->get();
        return view('juegos.index', compact('juegos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        $modalidades = Modalidad::all();
        return view('juegos.create', compact('categorias', 'modalidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'NombreJuego' => 'required|string|max:255',
            'DescripcionJuego' => 'required|string',
            'IDCategoria' => 'required|exists:categorias,IDCategoria',
            'IDModalidad' => 'required|exists:modalidades,IDModalidad',
            'ImagenJuego' => 'nullable|image',
        ]);

        if ($request->hasFile('ImagenJuego')) {
            $validated['ImagenJuego'] = $request->file('ImagenJuego')->store('imagenes/juegos', 'public');
        }

        $juego = Juego::create($validated);

        // Devuelve una respuesta JSON
        return response()->json([
            'message' => 'Juego guardado de forma correcta',
            'juego' => $juego,
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Juego $juego)
    {
        $categorias = Categoria::all();
        $modalidades = Modalidad::all();
        return view('juegos.edit', compact('juego'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Juego $juego)
    {
        $validated = $request->validate([
            'NombreJuego' => 'required|string|max:255',
            'DescripcionJuego' => 'required|string',
            'IDCategoria' => 'required|exists:categorias,IDCategoria',
            'IDModalidad' => 'required|exists:modalidades,IDModalidad',
            'ImagenJuego' => 'nullable|image',
        ]);

        if ($request->hasFile('ImagenJuego')) {
            $validated['ImagenJuego'] = $request->file('ImagenJuego')->store('imagenes/juegos', 'public');
        }

        $juego->update($validated);

        return redirect()->route('juegos.index')->with('success', 'Juego actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Juego $juego)
    {
        $juego->delete();
        return redirect()->route('juegos.index')->with('success', 'Juego eliminado con éxito.');
    }

    public function showHomePage() {
        $juegos = Juego::all(); // Obtén todos los juegos
        return view('welcome', compact('juegos'));
    }
    public function list()
    {
        $juegos = Juego::all();
        return response()->json($juegos);
    }

}
