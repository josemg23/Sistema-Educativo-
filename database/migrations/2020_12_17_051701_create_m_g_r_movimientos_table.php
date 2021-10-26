<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMGRMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_g_r_movimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('m_g_registro_id');
            $table->text('tipo')->nullable();
            $table->string('fecha')->nullable();
            $table->text('detalle')->nullable();
            $table->string('debe')->nullable();
            $table->string('haber')->nullable();
            $table->string('saldo')->nullable();
            $table->timestamps();
            $table->foreign('m_g_registro_id')
            ->references('id')
            ->on('m_g_registros')
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
        Schema::dropIfExists('m_g_r_movimientos');
    }
}
