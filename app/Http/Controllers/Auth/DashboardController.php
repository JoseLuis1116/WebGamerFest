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
        $role = Auth::user()->rol->NombreRol;

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
