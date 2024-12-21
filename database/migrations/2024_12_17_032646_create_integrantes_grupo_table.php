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
        Schema::create('integrantes_grupo', function (Blueprint $table) {
            $table->id('id_integrante'); // Clave primaria
            $table->foreignId('id_grupo')->constrained('Grupos', 'IDGrupo')->onDelete('restrict'); // Referencia corregida
            $table->foreignId('id_usuario')->constrained('usuarios')->onDelete('restrict'); // Referencia a users
            $table->timestamps();

            // Restricción única para evitar duplicados
            $table->unique(['id_grupo', 'id_usuario']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integrantes_grupo');
    }
};
