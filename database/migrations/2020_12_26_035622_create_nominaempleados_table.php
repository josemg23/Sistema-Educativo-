<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominaempleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominaempleados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
            $table->string('nombre')->nullable();
            $table->string('fecha')->nullable();
            $table->string('s_sueldo')->nullable();
            $table->string('s_sobretiempo')->nullable();
            $table->string('s_tingreso')->nullable();
            $table->string('s_iess')->nullable();
            $table->string('s_piess')->nullable();
            $table->string('s_pcias')->nullable();
            $table->string('s_anticipo')->nullable();
            $table->string('s_impr')->nullable();
            $table->string('s_tegresos')->nullable();
            $table->string('s_netopagar')->nullable();
            
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
        Schema::dropIfExists('nominaempleados');
    }
}
