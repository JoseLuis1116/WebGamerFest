<?php

namespace Tests\Feature;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase; // Limpia la base de datos entre pruebas

    /**
     * Configura los datos iniciales para las pruebas.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Crear roles
        $this->adminRole = Rol::factory()->create(['NombreRol' => 'Administrador']);
        $this->tesoreriaRole = Rol::factory()->create(['NombreRol' => 'Tesoreria']);

        // Crear usuarios
        $this->adminUser = Usuario::factory()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Contraseña encriptada
            'IDRol' => $this->adminRole->IDRol,
        ]);

        $this->tesoreriaUser = Usuario::factory()->create([
            'email' => 'tesoreria@example.com',
            'password' => Hash::make('password'),
            'IDRol' => $this->tesoreriaRole->IDRol,
        ]);
    }

    /**
     * Prueba que un usuario administrador puede iniciar sesión y ser redirigido.
     */
    public function test_admin_can_login_and_redirect()
    {
        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($this->adminUser);
    }

    /**
     * Prueba que un usuario de tesorería puede iniciar sesión y ser redirigido.
     */
    public function test_tesoreria_can_login_and_redirect()
    {
        $response = $this->post('/login', [
            'email' => 'tesoreria@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/tesoreria/dashboard');
        $this->assertAuthenticatedAs($this->tesoreriaUser);
    }

    /**
     * Prueba que un usuario no puede iniciar sesión con credenciales incorrectas.
     */
    public function test_user_cannot_login_with_invalid_credentials()
    {
        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest(); // El usuario no está autenticado
    }
}
