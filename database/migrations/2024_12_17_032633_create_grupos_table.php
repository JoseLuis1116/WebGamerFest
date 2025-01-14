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
        Schema::create('Grupos', function (Blueprint $table) {
            $table->id('IDGrupo'); // Clave primaria
            $table->string('nombre_equipo');
            $table->foreignId('IDLider')->constrained('usuarios')->onDelete('cascade'); // Referencia a usuarios
            $table->foreignId('IDJuego')->constrained('Juegos', 'IDJuego')->onDelete('cascade');

            // Campos adicionales
            $table->enum('estado', ['Pendiente', 'Verificado'])->default('Pendiente'); // Estado del grupo
            $table->string('numero_comprobante')->nullable(); // Número de comprobante
            $table->blob('comprobante')->nullable(); // Archivo de comprobante (imagen)
            $table->date('fecha_inscripcion')->nullable(); // Fecha de inscripción
            $table->date('fecha_pago')->nullable(); // Fecha de pago

            $table->timestamps(); // Marcas de tiempo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Grupos');
    }
};
