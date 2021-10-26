<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallerBalanceInicialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taller_balance_inicials', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_modulo_contable_id');
            $table->string('tipo');
            $table->longText('enunciado')->nullable();
            $table->text('transacciones');
            $table->timestamps();
            
            $table->foreign('taller_modulo_contable_id')
            ->references('id')
            ->on('taller_modulo_contables')
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
        Schema::dropIfExists('taller_balance_inicials');
    }
}
