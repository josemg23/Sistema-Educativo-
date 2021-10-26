<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoSaldoDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_saldo_datos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('tipo_saldo_id');
            $table->string('pregunta')->nullable();
            $table->string('respuesta')->nullable();
            $table->string('total_debe')->nullable();
            $table->string('total_haber')->nullable();
            $table->timestamps();

            $table->foreign('tipo_saldo_id')
            ->references('id')
            ->on('tipo_saldos')
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
        Schema::dropIfExists('tipo_saldo_datos');
    }
}
