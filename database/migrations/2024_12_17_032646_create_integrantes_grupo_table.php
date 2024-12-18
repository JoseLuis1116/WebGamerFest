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
            $table->id('id_integrante');
            $table->foreignId('id_grupo')->constrained('Grupos', 'IDGrupo')->onDelete('restrict');
            $table->foreignId('id_participante')->constrained('Participantes', 'IDParticipante')->onDelete('restrict');
            $table->timestamps();
        
            // Restricción única para evitar duplicados
            $table->unique(['id_grupo', 'id_participante']);
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('IntegrantesGrupo');
    }
};
