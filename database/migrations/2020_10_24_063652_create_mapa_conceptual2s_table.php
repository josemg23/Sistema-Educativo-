<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapaConceptual2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapa_conceptual2s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
            $table->longText('enunciado');
            $table->string('respuesta')->nullable();
            $table->string('enunciado1')->nullable();
            $table->string('enunciado2')->nullable();
            $table->string('enunciado3')->nullable();
            $table->string('enunciado4')->nullable();
            $table->string('enunciado5')->nullable();
            $table->string('enunciado6')->nullable();
            $table->string('respuesta1')->nullable();
            $table->string('respuesta2')->nullable();
            $table->string('respuesta3')->nullable();
            $table->string('respuesta4')->nullable();
            $table->string('respuesta5')->nullable();
            $table->string('respuesta6')->nullable();
            $table->timestamps();
            
            $table->foreign('taller_id')
            ->references('id')
            ->on('tallers')
            ->onDelete('cascade');

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('mapa_conceptual2s');
    }
}
