<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Tesoreria', function (Blueprint $table) {
            $table->id('IDTesoreria');
            $table->unsignedBigInteger('IDRol'); // Asegúrate de definir primero
            $table->string('Nombres');
            $table->string('Apellidos');
            $table->string('Celular')->nullable();
            $table->string('CorreoElectronico')->unique();
            $table->string('Contrasenia');
            $table->timestamps();

            // Clave foránea después de definir la columna
            $table->foreign('IDRol')->references('IDRol')->on('Roles')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Tesoreria');
    }
};