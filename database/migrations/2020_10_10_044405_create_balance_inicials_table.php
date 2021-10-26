<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceInicialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_inicials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
            $table->longText('enunciado')->nullable();
            $table->string('nombre')->nullable();
            $table->string('tipo')->nullable();
            $table->string('fecha')->nullable();
            $table->string('total_activo_corriente')->nullable();
            $table->string('total_activo_nocorriente')->nullable();
            $table->string('total_pasivo_corriente')->nullable();
            $table->string('total_pasivo_nocorriente')->nullable();
            $table->string('total_activo')->nullable();
            $table->string('total_pasivo')->nullable();
            $table->string('total_patrimonio')->nullable();
            $table->string('total_pasivo_patrimonio')->nullable();
            $table->timestamps();

            $table->foreign('taller_id')
            ->references('id')
            ->on('tallers')
            ->onDelete('cascade');

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('balance_inicials');
    }
}
