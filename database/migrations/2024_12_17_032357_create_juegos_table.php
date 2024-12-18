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
        Schema::create('Juegos', function (Blueprint $table) {
            $table->id('IDJuego');
            $table->string('NombreJuego');
            $table->text('DescripcionJuego')->nullable();
            $table->foreignId('IDCategoria')->constrained('Categorias', 'IDCategoria')->onDelete('cascade');
            $table->foreignId('IDModalidad')->constrained('Modalidades', 'IDModalidad')->onDelete('cascade');
            $table->binary('ImagenJuego')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Juegos');
    }
};
