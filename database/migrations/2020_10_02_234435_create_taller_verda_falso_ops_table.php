<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallerVerdaFalsoOpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taller_verda_falso_ops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_verdadero_falso_id');
            $table->longText('descripcion');
            $table->longText('respuesta');
            $table->timestamps();
            
            $table->foreign('taller_verdadero_falso_id')
            ->references('id')
            ->on('taller_verdadero_falsos')
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
        Schema::dropIfExists('taller_verda_falso_ops');
    }
}
