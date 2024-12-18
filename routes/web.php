<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;




// Ruta para el coordinador
Route::get('/coordinador', function () {
    return view('usuarios.coordinador.coordinador');
})->name('coordinador');

// Ruta para el tesorero
Route::get('/tesorero', function () {
    return view('usuarios.tesorero.tesorero');
})->name('tesorero');


Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
