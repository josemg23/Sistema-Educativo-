<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaVentaDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_venta_datos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('nota_venta_id');
            $table->string('cantidad')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('precio')->nullable();
            $table->string('valor_venta')->nullable();
            $table->timestamps();

            $table->foreign('nota_venta_id')
            ->references('id')
            ->on('nota_ventas')
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
        Schema::dropIfExists('nota_venta_datos');
    }
}
