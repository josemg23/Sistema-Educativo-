<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalizarPreguntaDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analizar_pregunta_datos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('analizar_pregunta_id');
            $table->longText('enunciado')->nullable();
            $table->longText('respuesta')->nullable();
            $table->timestamps();

            $table->foreign('analizar_pregunta_id')
            ->references('id')
            ->on('analizar_preguntas')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analizar_pregunta_datos');
    }
}
