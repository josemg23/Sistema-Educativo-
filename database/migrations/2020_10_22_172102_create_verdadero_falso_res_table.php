<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerdaderoFalsoResTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verdadero_falso_res', function (Blueprint $table) {
                  $table->bigIncrements('id');
            $table->unsignedbigInteger('verdadero_falso_id');
            $table->longText('enunciado')->nullable();
            $table->longText('respuesta')->nullable();
            $table->timestamps();


            $table->foreign('verdadero_falso_id')
            ->references('id')
            ->on('verdadero_falsos')
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
        Schema::dropIfExists('verdadero_falso_res');
    }
}
