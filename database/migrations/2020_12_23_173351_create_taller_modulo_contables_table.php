<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallerModuloContablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taller_modulo_contables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->string('metodo');
            $table->string('tipo');
            $table->longText('enunciado')->nullable();
            $table->string('archivo')->nullable();
            $table->longText('modulos')->nullable();
            $table->boolean('balance_inicial_vertical')->default(0);
            $table->boolean('balance_inicial_horizontal')->default(0);
            $table->boolean('kardex_fifo')->default(0);
            $table->boolean('kardex_promedio')->default(0);
            $table->boolean('diario_general')->default(0);
            $table->boolean('mayor_general')->default(0);
            $table->boolean('balance_comprobacion')->default(0);
            $table->boolean('hoja_trabajo')->default(0);
            $table->boolean('balance_comprobacion_ajustado')->default(0);
            $table->boolean('estado_resultado')->default(0);
            $table->boolean('balance_general')->default(0);
            $table->boolean('asientos_cierre')->default(0);
            $table->boolean('librocaja')->default(0);
            $table->boolean('conciliacionbancaria')->default(0);
            $table->boolean('arqueocaja')->default(0);
            $table->boolean('librobanco')->default(0);
            $table->boolean('retencioniva')->default(0);
            $table->boolean('nominaempleados')->default(0);
            $table->boolean('provisiondebeneficio')->default(0);
            $table->timestamps();
            
            $table->foreign('taller_id')
            ->references('id')
            ->on('tallers')
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
        Schema::dropIfExists('taller_modulo_contables');
    }
}
