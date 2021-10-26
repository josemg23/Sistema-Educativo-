<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKFRMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_f_r_movimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('k_f_registro_id');
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
            $table->foreign('k_f_registro_id')
            ->references('id')
            ->on('k_f_registros')
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
        Schema::dropIfExists('k_f_r_movimientos');
    }
}
