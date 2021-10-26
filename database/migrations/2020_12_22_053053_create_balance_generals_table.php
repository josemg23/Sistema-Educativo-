<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_generals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
            $table->string('nombre')->nullable();
            $table->string('fecha')->nullable();
            $table->string('t_activo')->nullable();
            $table->string('t_pasivo')->nullable();
            $table->string('t_a_corriente')->nullable();
            $table->string('t_a_nocorriente')->nullable();
            $table->string('t_p_corriente')->nullable();
            $table->string('t_p_no_corriente')->nullable();
            $table->string('t_patrimonio')->nullable();
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
        Schema::dropIfExists('balance_generals');
    }
}
