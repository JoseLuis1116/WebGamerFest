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
            $table->foreignId('IDLider')->constrained('usuarios')->onDelete('cascade'); // Referencia a users
            $table->foreignId('IDJuego')->constrained('Juegos', 'IDJuego')->onDelete('cascade');
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
