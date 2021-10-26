<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajadatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajadatos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('anexocaja_id');
            $table->string('fecha');
            $table->string('detalle');
            $table->string('debe')->nullable();
            $table->string('haber')->nullable();
            $table->string('saldo')->nullable();
            $table->timestamps();

            $table->foreign('anexocaja_id')
            ->references('id')
            ->on('anexocajas')
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
        Schema::dropIfExists('cajadatos');
    }
}
