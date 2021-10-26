<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdenTrasaDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iden_trasa_datos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('iden_trasa_id');
            $table->longText('pregunta')->nullable();
            $table->longText('respuesta')->nullable();
            $table->timestamps();

            $table->foreign('iden_trasa_id')
            ->references('id')
            ->on('iden_trasas')
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
        Schema::dropIfExists('iden_trasa_datos');
    }
}
