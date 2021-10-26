<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKPRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_p_registros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('kardex_promedio_id');
            $table->text('fecha')->nullable();
            $table->text('movimiento')->nullable();
            $table->text('tipo')->nullable();
            $table->string('ingreso_cantidad')->nullable();
            $table->string('ingreso_precio')->nullable();
            $table->string('ingreso_total')->nullable();
            $table->string('egreso_cantidad')->nullable();
            $table->string('egreso_precio')->nullable();
            $table->string('egreso_total')->nullable();
            $table->string('existencia_cantidad')->nullable();
            $table->string('existencia_precio')->nullable();
            $table->string('existencia_total')->nullable();
            $table->timestamps();
            $table->foreign('kardex_promedio_id')
            ->references('id')
            ->on('kardex_promedios')
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
        Schema::dropIfExists('k_p_registros');
    }
}
