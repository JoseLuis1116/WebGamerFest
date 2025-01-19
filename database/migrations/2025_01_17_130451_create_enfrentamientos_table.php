<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnfrentamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enfrentamientos', function (Blueprint $table) {
            $table->bigIncrements('idEnfrentamiento');
            $table->unsignedBigInteger('IDJuego');
            $table->unsignedBigInteger('participante1');
            $table->unsignedBigInteger('participante2');
            $table->string('ronda')->default('Primera Ronda'); // Campo para indicar la ronda
            $table->dateTime('fecha'); // Fecha del enfrentamiento
            $table->enum('estado', ['Pendiente', 'En proceso', 'Finalizado'])->default('Pendiente');
            $table->string('resultado')->nullable(); // Resultado del enfrentamiento
            $table->timestamps();

            // Foreign keys
            $table->foreign('IDJuego')
                  ->references('IDJuego')
                  ->on('juegos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('participante1')
                  ->references('id')
                  ->on('usuarios')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('participante2')
                  ->references('id')
                  ->on('usuarios')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enfrentamientos');
    }
}
