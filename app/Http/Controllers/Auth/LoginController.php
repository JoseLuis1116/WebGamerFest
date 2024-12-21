<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Autentica al usuario y redirige al dashboard según su rol.
     */
    public function authenticate(Request $request)
    {
        // Validar credenciales
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Intentar autenticación
        if (Auth::attempt($credentials)) {
            // Regenerar la sesión para evitar ataques de fijación de sesión
            $request->session()->regenerate();

            // Obtener el usuario autenticado
            $user = Auth::user();

            // Verificar si tiene un IDRol válido
            if (empty($user->IDRol)) {
                Auth::logout();
                return redirect()->route('login')->withErrors(['error' => 'Usuario sin rol asignado. Contacte al administrador.']);
            }

            // Redirigir según el ID del rol
            return $this->redirectToDashboard($user->IDRol);
        }

        // Si las credenciales no son correctas
        return back()->withErrors([
            'email' => 'Las credenciales no son correctas.',
        ])->onlyInput('email');
    }

    /**
     * Redirige al dashboard correspondiente según el ID del rol.
     */
    private function redirectToDashboard(int $roleId)
    {
        switch ($roleId) {
            case 1: // Administrador
                return redirect()->route('admin.dashboard');
            case 2: // Tesorería
                return redirect()->route('tesoreria.dashboard');
            case 3: // Coordinador
                return redirect()->route('coordinador.dashboard');
            case 4: // Participante
                return redirect()->route('participante.dashboard'); // Asegúrate de que esta ruta exista
            default:
                // Rol no autorizado
                Auth::logout();
                return redirect()->route('login')->withErrors(['error' => 'Rol no autorizado.']);
        }
    }
}
