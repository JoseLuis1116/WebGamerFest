<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Usuario;
use App\Models\Participante;

class UsuarioTest extends TestCase
{
    use RefreshDatabase; // Limpia la base de datos después de cada prueba

    /** @test */
    public function un_usuario_se_puede_registrar_correctamente()
    {
        // 1. Simular los datos enviados desde el formulario
        $datos = [
            'Nombres' => 'Juan',
            'Apellidos' => 'Pérez',
            'Celular' => '0991234567',
            'Universidad' => 'ESPOL',
            'CorreoElectronico' => 'juan@example.com',
            'Contrasenia' => 'password123',
            'Contrasenia_confirmation' => 'password123', // Confirmación de contraseña
        ];

        // 2. Enviar una petición POST al método store
        $response = $this->post(route('usuarios.store'), $datos);

        // 3. Verificar que el usuario fue creado en la base de datos
        $this->assertDatabaseHas('Usuarios', [
            'Nombres' => 'Juan',
            'Apellidos' => 'Pérez',
            'Celular' => '0991234567',
            'Universidad' => 'ESPOL',
            'CorreoElectronico' => 'juan@example.com',
        ]);

        // 4. Verificar que también fue creado en la tabla Participantes
        $this->assertDatabaseHas('Participantes', [
            'Nombres' => 'Juan',
            'Apellidos' => 'Pérez',
            'Celular' => '0991234567',
            'Universidad' => 'ESPOL',
            'CorreoElectronico' => 'juan@example.com',
        ]);

        // 5. Verificar que la redirección fue exitosa
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Usuario registrado correctamente.');
    }
}
