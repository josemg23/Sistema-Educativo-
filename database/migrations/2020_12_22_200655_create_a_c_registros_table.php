<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateACRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_c_registros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('asiento_cierre_id');
            $table->string('no_registro');
            $table->string('comentario')->nullable();
            $table->string('fecha')->nullable();
            $table->timestamps();


            $table->foreign('asiento_cierre_id')
            ->references('id')
            ->on('asiento_cierres')
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
        Schema::dropIfExists('a_c_registros');
    }
}
