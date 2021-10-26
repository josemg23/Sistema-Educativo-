<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallerFacturaDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taller_factura_datos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_factura_id');
            $table->text('codigo')->nullable();
            $table->string('cod_auxiliar')->nullable();
            $table->string('cantidad')->nullable();
            $table->longText('descripcion')->nullable();
            $table->string('precio')->nullable();
            $table->timestamps();

            $table->foreign('taller_factura_id')
            ->references('id')
            ->on('taller_facturas')
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
        Schema::dropIfExists('taller_factura_datos');
    }
}
