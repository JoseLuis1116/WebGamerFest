<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatrocinadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Patrocinadores', function (Blueprint $table) {
            $table->id('IDPatrocinador'); // Primary key, autoincremental
            $table->string('NombrePatrocinador');
            $table->text('InformacionPatrocinador')->nullable();
            $table->string('UbicacionPatrocinador')->nullable();
            $table->binary('LogoPatrocinador')->nullable(); // BLOB field
            $table->timestamps(); // Adds created_at and updated_at columns
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Patrocinadores');
    }
}
