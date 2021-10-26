<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompletarEnunciadoResTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('completar_enunciado_res', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->unsignedbigInteger('completar_enunciado_id');
            $table->longText('respuesta')->nullable();
            $table->timestamps();

            $table->foreign('completar_enunciado_id')
            ->references('id')
            ->on('completar_enunciados')
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
        Schema::dropIfExists('completar_enunciado_res');
    }
}
