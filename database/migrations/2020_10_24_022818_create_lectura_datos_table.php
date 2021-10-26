<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturaDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lectura_datos', function (Blueprint $table) {
             $table->bigIncrements('id');
            $table->unsignedbigInteger('lectura_id');
            $table->longText('pregunta')->nullable();
            $table->longText('respuesta')->nullable();
            $table->timestamps();

            $table->foreign('lectura_id')
            ->references('id')
            ->on('lecturas')
            ->onDelete('cascade');        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lectura_datos');
    }
}
