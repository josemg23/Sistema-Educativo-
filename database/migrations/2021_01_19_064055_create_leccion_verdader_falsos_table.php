<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeccionVerdaderFalsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leccion_verdader_falsos', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->unsignedbigInteger('leccion_id');
            $table->text('enunciado')->nullable();
            $table->text('titulo')->nullable();
            $table->text('respuesta')->nullable();
            $table->timestamps();
            $table->foreign('leccion_id')->references('id')->on('leccions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leccion_verdader_falsos');
    }
}
