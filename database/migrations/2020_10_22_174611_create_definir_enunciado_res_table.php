<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefinirEnunciadoResTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('definir_enunciado_res', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('definir_enunciado_id');
            $table->longText('concepto')->nullable();
            $table->longText('respuesta')->nullable();
            $table->timestamps();


            $table->foreign('definir_enunciado_id')
            ->references('id')
            ->on('definir_enunciados')
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
        Schema::dropIfExists('definir_enunciado_res');
    }
}
