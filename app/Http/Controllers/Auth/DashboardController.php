<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Maneja la redirección del usuario a su dashboard según el rol.
     */
    public function handle()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si el usuario tiene un rol asignado
        if (!$user || !$user->rol) {
            Auth::logout();
            return redirect('/login')->withErrors('No tienes un rol asignado.');
        }

        // Redirigir al dashboard correspondiente con el nombre y rol del usuario
        $dashboardView = match ($user->rol) {
            'administrador' => '/admin', // Ruta del panel de Filament
            'participante' => '/participantes',
            'tesoreria' => '/coordinador',
            'coordinador' => 'coordinator.dashboard',
            default => 'home',
        };

        return view($dashboardView, ['user' => $user]);
    }
}
