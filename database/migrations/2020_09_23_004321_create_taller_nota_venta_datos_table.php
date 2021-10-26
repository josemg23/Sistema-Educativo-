<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallerNotaVentaDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taller_nota_venta_datos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_nota_venta_id');
            $table->string('cantidad')->nullable();
            $table->longText('descripcion')->nullable();
            $table->string('precio')->nullable();
            $table->timestamps();

            $table->foreign('taller_nota_venta_id')
            ->references('id')
            ->on('taller_nota_ventas')
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
        Schema::dropIfExists('taller_nota_venta_datos');
    }
}
