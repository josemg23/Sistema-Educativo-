<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallerALecturaOpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taller_a_lectura_ops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_a_lectura_id');
            $table->longText('enunciado')->nullable();
            $table->timestamps();
            
            $table->foreign('taller_a_lectura_id')
            ->references('id')
            ->on('taller_a_lecturas')
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
        Schema::dropIfExists('taller_a_lectura_ops');
    }
}
