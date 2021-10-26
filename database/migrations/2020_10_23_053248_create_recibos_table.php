<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
            $table->longText('enunciado');
            $table->string('no')->nullable();
            $table->string('por')->nullable();
            $table->string('recibi')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('arriendo')->nullable();
            $table->string('propiedad')->nullable();
            $table->string('situado')->nullable();
            $table->string('cubierto')->nullable();
            $table->string('espacio')->nullable();
            $table->string('hasta')->nullable();
            $table->string('firma')->nullable();
            $table->string('ocupa')->nullable();
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
        Schema::dropIfExists('recibos');
    }
}
