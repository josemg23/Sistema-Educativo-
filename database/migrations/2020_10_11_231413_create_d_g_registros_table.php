<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDGRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_g_registros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('diario_general_id');
            $table->string('no_registro');
            $table->string('comentario')->nullable();
            $table->string('fecha')->nullable();
            $table->string('tipo')->nullable();
            $table->timestamps();


            $table->foreign('diario_general_id')
            ->references('id')
            ->on('diario_generals')
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
        Schema::dropIfExists('d_g_registros');
    }
}
