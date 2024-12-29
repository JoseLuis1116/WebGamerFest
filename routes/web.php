<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\JuegoController;

// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rutas de registro de usuario
Route::get('/register', [UsuarioController::class, 'create'])->name('register'); // Mostrar formulario de registro
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store'); // Guardar datos del usuario
Route::post('/guardar-juego', [JuegoController::class, 'store'])->name('juegos.store'); // Guardar juego

//Ruta parar el contralador de juegos
Route::resource('juegos', JuegoController::class);

// Ruta para el inicio de sesión (manteniendo Fortify)
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

// Rutas protegidas con middleware de autenticación
Route::middleware(['auth'])->group(function () {

    // Ruta de redirección central para los dashboards
    Route::get('/dashboard', [DashboardController::class, 'handle'])->name('dashboard');

    // Rutas específicas para cada rol
    Route::get('/admin/dashboard', function () {
        return view('usuarios.administrador.administrador'); // Vista correcta
    })->name('admin.dashboard');

    Route::get('/tesoreria/dashboard', function () {
        return view('usuarios.tesorero.tesorero'); // Ruta correcta
    })->name('tesoreria.dashboard');

    Route::get('/coordinador/dashboard', function () {
        return view('usuarios.coordinador.coordinador'); // Ruta correcta
    })->name('coordinador.dashboard');

    Route::get('/participante/dashboard', function () {
        return view('usuarios.participantes.participantes'); // Ruta correcta
    })->name('participante.dashboard');
    Route::get('/', [JuegoController::class, 'showHomePage'])->name('home');
    Route::get('/juegos/{juego}/edit', [JuegoController::class, 'edit'])->name('juegos.edit');



});

// Rutas para administradores (resource)
Route::resource('administradores', AdministradorController::class)->middleware('auth');
Route::get('/api/juegos', [JuegoController::class, 'list']);

