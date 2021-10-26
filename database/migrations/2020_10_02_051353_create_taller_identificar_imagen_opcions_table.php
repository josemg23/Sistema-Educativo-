<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallerIdentificarImagenOpcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taller_identificar_imagen_opcions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_img_id');
            $table->string('col_a')->nullable();
            $table->string('col_b')->nullable();
            $table->timestamps();


            $table->foreign('taller_img_id')
            ->references('id')
            ->on('taller_identificar_imagens')
            ->onDelete('cascade');        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taller_identificar_imagen_opcions');
    }
}
