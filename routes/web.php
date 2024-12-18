<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\DashboardController;



// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Rutas para el coordinador
Route::get('/coordinador', function () {
    return view('usuarios.coordinador.coordinador');
})->name('coordinador');

// Ruta para el tesorero
Route::get('/tesorero', function () {
    return view('usuarios.tesorero.tesorero');
})->name('tesorero');

// Rutas de usuarios
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::post('/usuarios/store', [UsuarioController::class, 'store'])->name('usuarios.store');

// Rutas de administradores (resource)
Route::resource('administradores', AdministradorController::class);

// Ruta para el inicio de sesión
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

// Middleware de autenticación para proteger rutas
Route::middleware(['auth'])->group(function () {

    // Ruta de redirección central para los dashboards
    Route::get('/dashboard', [DashboardController::class, 'handle'])->name('dashboard');

    // Rutas específicas para cada rol
    Route::get('/admin/dashboard', function () {
        return view('livewire.admin-dashboard');
    })->name('admin.dashboard');

    Route::get('/tesoreria/dashboard', function () {
        return view('livewire.tesoreria-dashboard');
    })->name('tesoreria.dashboard');

    Route::get('/coordinador/dashboard', function () {
        return view('livewire.coordinador-dashboard');
    })->name('coordinador.dashboard');

    Route::get('/participante/dashboard', function () {
        return view('livewire.participante-dashboard');
    })->name('participante.dashboard');
});
