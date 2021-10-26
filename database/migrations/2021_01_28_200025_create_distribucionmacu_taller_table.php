<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistribucionmacuTallerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribucionmacu_taller', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('distribucionmacu_id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('contenido_id')->nullable();
            $table->unsignedbigInteger('plantilla_id')->nullable();
            $table->unsignedBigInteger('nivel_id');
            $table->boolean('estado')->nullable();
            $table->string('fecha_entrega')->nullable();
            $table->timestamps();
            $table->foreign('distribucionmacu_id')->references('id')->on('distribucionmacus')->onDelete('cascade');
            $table->foreign('contenido_id')->references('id')->on('contenidos')->onDelete('cascade');
            $table->foreign('taller_id')->references('id')->on('tallers')->onDelete('cascade');
            $table->foreign('nivel_id')->references('id')->on('nivels')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distribucionmacu_taller');
    }
}
