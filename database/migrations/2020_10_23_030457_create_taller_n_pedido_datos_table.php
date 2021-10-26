<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallerNPedidoDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taller_n_pedido_datos', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedbigInteger('taller_nota_pedido_id');
                $table->text('cantidad')->nullable();
                $table->string('codigo')->nullable();
                $table->string('descripcion')->nullable();
                $table->string('precio_unit')->nullable();
                $table->timestamps();

                $table->foreign('taller_nota_pedido_id')
                ->references('id')
                ->on('taller_nota_pedidos')
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
        Schema::dropIfExists('taller_n_pedido_datos');
    }
}
