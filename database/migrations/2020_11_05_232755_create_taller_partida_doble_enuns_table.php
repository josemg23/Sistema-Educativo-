<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallerPartidaDobleEnunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taller_partida_doble_enuns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_partida_doble_id');
            $table->longText('enunciados')->nullable();
            $table->timestamps();
            
            $table->foreign('taller_partida_doble_id')
            ->references('id')
            ->on('taller_partida_dobles')
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
        Schema::dropIfExists('taller_partida_doble_enuns');
    }
}
