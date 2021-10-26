<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoSaldoHabersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_saldo_habers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_tipo_saldo_id');
            $table->string('nom_cuenta');
            $table->string('saldo');
            $table->timestamps();


            $table->foreign('taller_tipo_saldo_id')
            ->references('id')
            ->on('taller_tipo_saldos')
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
        Schema::dropIfExists('tipo_saldo_habers');
    }
}
