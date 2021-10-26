<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallerRelacionarOpcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taller_relacionar_opcions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_relacionar_id');
            $table->integer('orden')->nullable();
            $table->longText('enunciado')->nullable();
            $table->text('definicion')->nullable();
            $table->text('definicion_aleatoria')->nullable();
            $table->string('img')->nullable();
            $table->timestamps();


            $table->foreign('taller_relacionar_id')
            ->references('id')
            ->on('taller_relacionars')
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
        Schema::dropIfExists('taller_relacionar_opcions');
    }
}
