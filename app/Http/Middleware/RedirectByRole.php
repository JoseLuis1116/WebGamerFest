<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectByRole
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
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
                    return redirect()->route('login')->withErrors('Rol no autorizado.');
            }
        }

        return $next($request);
    }
}
