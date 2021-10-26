<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCeldaClasificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('celda_clasificados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('celda_id');
            $table->unsignedbigInteger('taller_celda_clasificacion_id');
            $table->text('nombre')->nullable();
            $table->timestamps();

            $table->foreign('celda_id')
            ->references('id')
            ->on('celdas')
            ->onDelete('cascade');  

            $table->foreign('taller_celda_clasificacion_id')
            ->references('id')
            ->on('taller_celda_clasificacions')
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
        Schema::dropIfExists('celda_clasificados');
    }
}
