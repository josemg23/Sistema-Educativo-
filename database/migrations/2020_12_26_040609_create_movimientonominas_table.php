<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientonominasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientonominas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('nominaempleado_id');
            $table->string('nombre_e');
            $table->string('cargo')->nullable();
            $table->string('sueldo')->nullable();
            $table->string('s_tiempo')->nullable();
            $table->string('ingresos')->nullable();
            $table->string('iees')->nullable();
            $table->string('pres_iees')->nullable();
            $table->string('pres_cia')->nullable();
            $table->string('anticipo')->nullable();
            $table->string('imp_renta')->nullable();
            $table->string('egresos')->nullable();
            $table->string('neto_pagar')->nullable();
            
            $table->timestamps();

            $table->foreign('nominaempleado_id')
            ->references('id')
            ->on('nominaempleados')
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
        Schema::dropIfExists('movimientonominas');
    }
}
