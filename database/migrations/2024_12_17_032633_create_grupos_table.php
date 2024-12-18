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
            $table->id('IDGrupo');
            $table->string('nombre_equipo');
            $table->foreignId('IDLider')->constrained('Participantes', 'IDParticipante')->onDelete('cascade');
            $table->foreignId('IDJuego')->constrained('Juegos', 'IDJuego')->onDelete('cascade');
            $table->dateTime('FechaInscripcion');
            $table->dateTime('FechaPago')->nullable();
            $table->decimal('Monto', 8, 2);
            $table->string('NumeroComprobante')->nullable();
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
        Schema::dropIfExists('Grupos');
    }
};