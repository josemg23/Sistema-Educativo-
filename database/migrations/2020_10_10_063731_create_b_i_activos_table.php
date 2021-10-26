<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBIActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_i_activos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('balance_inicial_id');
            $table->string('fecha')->nullable();
            $table->unsignedbigInteger('cuenta_id')->nullable();
            $table->string('nom_cuenta')->nullable();
            $table->string('saldo')->nullable();
            $table->string('tipo')->nullable();
            $table->timestamps();


            $table->foreign('balance_inicial_id')
            ->references('id')
            ->on('balance_inicials')
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
        Schema::dropIfExists('b_i_activos');
    }
}
