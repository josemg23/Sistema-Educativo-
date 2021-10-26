<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartidaDobleEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partida_doble_estados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('partida_doble_id');
            $table->text('descripcion')->nullable();
            $table->string('saldo1')->nullable();
            $table->string('saldo2')->nullable();
            $table->timestamps();

            $table->foreign('partida_doble_id')
            ->references('id')
            ->on('partida_dobles')
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
        Schema::dropIfExists('partida_doble_estados');
    }
}
