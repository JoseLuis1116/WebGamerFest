<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\DashboardController;

// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rutas de registro de usuario
Route::get('/register', [UsuarioController::class, 'create'])->name('register'); // Mostrar formulario de registro
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store'); // Guardar datos del usuario

// Ruta para el inicio de sesión (manteniendo Fortify)
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

// Rutas protegidas con middleware de autenticación
Route::middleware(['auth'])->group(function () {

    // Ruta de redirección central para los dashboards
    Route::get('/dashboard', [DashboardController::class, 'handle'])->name('dashboard');

    // Rutas específicas para cada rol
    Route::get('/admin/dashboard', function () {
        return view('usuarios.admin.admin'); // Cambiar si necesitas una vista específica
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
});

// Rutas para administradores (resource)
Route::resource('administradores', AdministradorController::class)->middleware('auth');
