<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
            $table->longText('enunciado');
            $table->string('nombre')->nullable();
            $table->string('fecha_emision')->nullable();
            $table->string('ruc')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('emision')->nullable();
            $table->string('subtotal_12')->nullable();
            $table->string('subtotal_0')->nullable();
            $table->string('subtotal_iva')->nullable();
            $table->string('subtotal_siniva')->nullable();
            $table->string('subtotal_sin_imp')->nullable();
            $table->string('descuento_total')->nullable();
            $table->string('ice')->nullable();
            $table->string('iva12')->nullable();
            $table->string('irbpnr')->nullable();
            $table->string('propina')->nullable();
            $table->string('valor_total')->nullable();
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
        Schema::dropIfExists('facturas');
    }
}
