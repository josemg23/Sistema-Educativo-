<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leccions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->unsignedbigInteger('plantilla_id');
            $table->unsignedbigInteger('contenido_id');
            $table->text('enunciado')->nullable();
            $table->text('option_titulo')->nullable();
            $table->text('option_correcta')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->boolean('estado');
            $table->timestamps();
            // $table->foreign('plantilla_id')->references('id')->on('plantillas')->onDelete('cascade');
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
        Schema::dropIfExists('leccions');
    }
}
