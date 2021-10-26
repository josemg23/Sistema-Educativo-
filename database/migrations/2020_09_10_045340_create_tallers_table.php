<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tallers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('plantilla_id');
            $table->string('nombre');
            $table->longText('enunciado')->nullable();
            $table->unsignedbigInteger('contenido_id');
            $table->date('fecha_entrega')->nullable();
            $table->boolean('estado');
            $table->timestamps();
            $table->foreign('plantilla_id')->references('id')->on('plantillas')->onDelete('cascade');
            $table->foreign('contenido_id')->references('id')->on('contenidos')->onDelete('cascade');


        });       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tallers');
    }
}
