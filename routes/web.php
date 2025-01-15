<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\InscripcionController;
use App\Models\user;

// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
})->name('home');

//Cierre de sesión
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de registro de usuario
Route::get('/register', [UsuarioController::class, 'create'])->name('register'); // Mostrar formulario de registro
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store'); // Guardar datos del usuario

//Ruta para traer la lista de juegos
Route::get('/api/juegos', [JuegoController::class, 'list']);

Route::get('/usuarios/list', [UsuarioController::class, 'list'])->name('usuarios.list');

Route::get('/juegos/list', [JuegoController::class, 'list'])->name('juegos.list');

Route::resource('inscripciones', InscripcionController::class);
//Ruta parar el contralador de juegos
Route::resource('juegos', JuegoController::class);

// Ruta para guardar juegos
Route::post('/guardar-juego', [JuegoController::class, 'store'])->name('juegos.store');

// Ruta para el controlador de juegos
Route::resource('juegos', JuegoController::class);

// Ruta para el inicio de sesión (manteniendo Fortify)
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

// Rutas protegidas con middleware de autenticación
Route::middleware(['auth'])->group(function () {

    // Ruta de redirección central para los dashboards
    Route::get('/dashboard', [DashboardController::class, 'handle'])->name('dashboard');

    // Rutas específicas para cada rol
    Route::get('/admin/dashboard', function () {
        return redirect('/admin'); // Redirige al dashboard de Filament
    })->name('admin.dashboard');

    Route::get('/tesoreria/dashboard', function () {
        return redirect('/tesoreria'); // Redirige al dashboard de Filament
    })->name('tesoreria.dashboard');

    // Rutas específicas para cada rol
    Route::get('/coordinador/dashboard', function () {
        return redirect('/coordinador'); // Redirige al dashboard de Filament
    })->name('coordinador.dashboard');

    // Rutas específicas para cada rol
    Route::get('/participantes/dashboard', function () {
        return redirect('/participantes'); // Redirige al dashboard de Filament
    })->name('participantes.dashboard');
});

//Ruta para los juegos
Route::get('/', [JuegoController::class, 'showHomePage'])->name('home');
Route::get('/dashboard-participante', function () {
    return app('App\Http\Controllers\JuegoController')->showHomePage('usuarios.participantes_dashboard');
})->name('participant.dashboard');

Route::get('/juegos/{juego}/edit', [JuegoController::class, 'edit'])->name('juegos.edit');

// Rutas para administradores (resource)
Route::resource('administradores', AdministradorController::class)->middleware('auth');
Route::get('/api/juegos', [JuegoController::class, 'list']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/participante/dashboard', [InscripcionController::class, 'create'])->name('participante.dashboard');
    Route::post('/participante/dashboard', [InscripcionController::class, 'store'])->name('inscripciones.store');
});
Route::get('/juegos/list', [JuegoController::class, 'list'])->name('juegos.list');

Route::post('/participante/dashboard', [InscripcionController::class, 'store'])->name('inscripciones.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/inscripciones/store', [InscripcionController::class, 'store'])->name('inscripciones.store');
});

Route::get('/participante/dashboard', [InscripcionController::class, 'create'])->name('participante.dashboard');

Route::post('/inscripciones/store', [InscripcionController::class, 'store'])->name('inscripciones.store');

// NUEVA RUTA: Perfil de usuario (Fortify/Jetstream)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile.show');
});