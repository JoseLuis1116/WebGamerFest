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
        Schema::create('Inscripciones', function (Blueprint $table) {
            $table->id('IDInscripcion');
            $table->foreignId('IDUsuario')->constrained('usuarios')->onDelete('cascade'); // Relación con usuarios
            $table->foreignId('IDJuego')->constrained('Juegos', 'IDJuego')->onDelete('cascade'); // Relación con Juegos
            $table->dateTime('FechaInscripcion');
            $table->dateTime('FechaPago')->nullable();
            $table->decimal('Monto', 8, 2);
            $table->string('NumeroComprobante')->unique(); // Declarar la columna antes de aplicar unique
            $table->enum('Estado', ['pendiente', 'aprobado'])->default('pendiente');
            $table->binary('ComprobantePago')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Inscripciones');
    }
};
