<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coordinadores_juegos', function (Blueprint $table) {
            $table->id(); // ID autoincremental de la relación
            $table->foreignId('IDCoordinador') // Relaciona al usuario con rol de coordinador
                  ->constrained('usuarios', 'id') // Relación con la tabla 'usuarios'
                  ->onDelete('cascade'); // Elimina el registro si el usuario es eliminado
            $table->foreignId('IDJuego') // Relaciona el juego
                  ->constrained('Juegos', 'IDJuego') // Relación con la tabla 'Juegos'
                  ->onDelete('cascade'); // Elimina el registro si el juego es eliminado
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Coordinadores_Juegos'); // Eliminar correctamente la tabla 'Coordinadores_Juegos'
    }
};
