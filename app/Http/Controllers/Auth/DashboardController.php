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
            return redirect()->route('login')->withErrors(['error' => 'El usuario no tiene un rol asignado. Contacte al administrador.']);
        }

        // Obtener el nombre del rol
        $role = $user->rol->NombreRol;

        // Redirigir según el rol
        switch ($role) {
            case 'Administrador':
                return redirect()->route('admin.dashboard');
            case 'Tesoreria':
                return redirect()->route('tesoreria.dashboard');
            case 'Coordinador':
                return redirect()->route('coordinador.dashboard');
            case 'Participante':
                return redirect()->route('participante.dashboard');
            default:
                Auth::logout();
                return redirect()->route('login')->withErrors(['error' => 'Rol no autorizado.']);
        }
    }
}
