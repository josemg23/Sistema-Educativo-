<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaPedidoResTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_pedido_res', function (Blueprint $table) {
            $table->bigIncrements('id');
                $table->unsignedbigInteger('nota_pedido_id');
                $table->text('cantidad')->nullable();
                $table->string('codigo')->nullable();
                $table->string('descripcion')->nullable();
                $table->string('precio_unit')->nullable();
                $table->string('total')->nullable();
                $table->timestamps();

                $table->foreign('nota_pedido_id')
                ->references('id')
                ->on('nota_pedidos')
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
        Schema::dropIfExists('nota_pedido_res');
    }
}
