<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirección según el rol del usuario
            $role = Auth::user()->rol->NombreRol;

            switch ($role) {
                case 'Administrador':
                    return redirect()->route('admin.dashboard');
                case 'Coordinador':
                    return redirect()->route('coordinador.dashboard');
                case 'Tesoreria':
                    return redirect()->route('tesoreria.dashboard');
                case 'Participante':
                    return redirect()->route('participante.dashboard');
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors('Rol no autorizado.');
            }
        }

        return back()->withErrors([
            'email' => 'Las credenciales no son correctas.',
        ])->onlyInput('email');
    }
}
