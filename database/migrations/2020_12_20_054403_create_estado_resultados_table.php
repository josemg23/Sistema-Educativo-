<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoResultadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_resultados', function (Blueprint $table) {
          $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
          $table->string('nombre')->nullable();
          $table->string('utilidad')->nullable();
          $table->string('fecha')->nullable();
          $table->string('venta')->nullable();
          $table->string('costo_venta')->nullable();
          $table->string('utilidad_bruta_ventas')->nullable();
          $table->string('utilidad_neta_o')->nullable();
          $table->string('utilidad_ejercicio')->nullable();
          $table->string('utilidad_liquida')->nullable();
          $table->string('total_ingresos')->nullable();
          $table->string('total_gastos')->nullable();
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
        Schema::dropIfExists('estado_resultados');
    }
}
