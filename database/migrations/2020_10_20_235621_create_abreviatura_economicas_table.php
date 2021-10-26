<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbreviaturaEconomicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abreviatura_economicas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
            $table->longText('enunciado');
            $table->string('abreviaturaI1')->nullable();
            $table->string('abreviaturaI2')->nullable();
            $table->string('abreviaturaI3')->nullable();
            $table->string('abreviaturaI4')->nullable();
            $table->string('abreviaturaI5')->nullable();
            $table->string('abreviaturaC1')->nullable();
            $table->string('abreviaturaC2')->nullable();
            $table->string('abreviaturaC3')->nullable();
            $table->string('abreviaturaC4')->nullable();
            $table->string('abreviaturaC5')->nullable();
            $table->string('abreviaturaR1')->nullable();
            $table->string('abreviaturaR2')->nullable();
            $table->string('abreviaturaR3')->nullable();
            $table->string('abreviaturaR4')->nullable();
            $table->string('abreviaturaR5')->nullable();
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
        Schema::dropIfExists('abreviatura_economicas');
    }
}
