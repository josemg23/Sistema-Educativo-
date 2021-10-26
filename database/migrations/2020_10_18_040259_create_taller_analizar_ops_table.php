<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallerAnalizarOpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taller_analizar_ops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_analizar_id');
            $table->longText('enunciado')->nullable();
            $table->timestamps();
            
            $table->foreign('taller_analizar_id')
            ->references('id')
            ->on('taller_analizars')
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
        Schema::dropIfExists('taller_analizar_ops');
    }
}
