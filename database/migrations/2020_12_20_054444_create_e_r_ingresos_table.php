<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateERIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_r_ingresos', function (Blueprint $table) {
             $table->bigIncrements('id');
            $table->unsignedbigInteger('estado_resultado_id');
            $table->unsignedbigInteger('cuenta_id')->nullable();
            $table->text('tipo')->nullable();
            $table->string('cuenta')->nullable();
            $table->string('saldo')->nullable();
            $table->timestamps();

             $table->foreign('estado_resultado_id')
            ->references('id')
            ->on('estado_resultados')
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
        Schema::dropIfExists('e_r_ingresos');
    }
}
