<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBIPatrimoniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_i_patrimonios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('balance_inicial_id');
            $table->string('fecha')->nullable();
            $table->unsignedbigInteger('cuenta_id');
            
            $table->string('nom_cuenta')->nullable();
            $table->string('saldo')->nullable();
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
        Schema::dropIfExists('b_i_patrimonios');
    }
}
