<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturaDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_datos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('factura_id');
            $table->string('codigo')->nullable();
            $table->string('cod_aux')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('precio')->nullable();
            $table->string('descuento')->nullable();
            $table->string('valor')->nullable();
            $table->timestamps();

            $table->foreign('factura_id')
            ->references('id')
            ->on('facturas')
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
        Schema::dropIfExists('factura_datos');
    }
}
