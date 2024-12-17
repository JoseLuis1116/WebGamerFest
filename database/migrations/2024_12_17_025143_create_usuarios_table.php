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
        Schema::create('Usuarios', function (Blueprint $table) {
            $table->id('IDUsuario');
            $table->string('Nombres');
            $table->string('Apellidos');
            $table->string('Universidad')->nullable();
            $table->string('Celular')->nullable();
            $table->string('CorreoElectronico')->unique();
            $table->string('Contrasenia');
            $table->foreignId('IDRol')->constrained('Roles', 'IDRol')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Usuarios');
    }
};
