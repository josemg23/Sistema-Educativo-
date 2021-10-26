<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuloPagaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulo_pagares', function (Blueprint $table) {
             $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
            // $table->longText('enunciado');
            $table->string('modulo')->nullable();
            $table->string('tipo_documento')->nullable();
            $table->string('por')->nullable();
            $table->string('fecha')->nullable();
            $table->string('nombre')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('interes')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('fecha_vencimiento')->nullable();
            $table->string('señor')->nullable();
            $table->string('deudor1')->nullable();
            $table->string('garante')->nullable();
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
        Schema::dropIfExists('modulo_pagares');
    }
}
