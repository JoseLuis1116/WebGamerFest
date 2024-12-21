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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('name'); // Nombre del usuario
            $table->string('email')->unique(); // Email único
            $table->string('password'); // Contraseña
            $table->string('Celular', 10)->nullable(); // Celular opcional
            $table->string('Universidad')->nullable(); // Universidad opcional
            $table->foreignId('IDRol') // ID del rol
                  ->constrained('roles', 'IDRol') // Relación con la tabla 'roles'
                  ->onDelete('cascade'); // Elimina usuarios si el rol es eliminado
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios'); // Eliminar correctamente la tabla 'usuarios'
    }
};
