<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKardexPromediosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardex_promedios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
            $table->unsignedbigInteger('producto_id')->nullable();
            $table->string('nombre');
            $table->string('producto')->nullable();
            $table->string('inv_inicial_cantidad')->nullable();
            $table->string('adquisicion_cantidad')->nullable();
            $table->string('ventas_cantidad')->nullable();
            $table->string('inv_final_cantidad')->nullable();
            $table->string('inv_inicial_precio')->nullable();
            $table->string('adquisicion_precio')->nullable();
            $table->string('ventas_precio')->nullable();
            $table->string('inv_final_precio')->nullable();
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
        Schema::dropIfExists('kardex_promedios');
    }
}
