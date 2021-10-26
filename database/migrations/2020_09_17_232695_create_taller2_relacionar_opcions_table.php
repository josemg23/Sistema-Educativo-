<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaller2RelacionarOpcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taller2_relacionar_opcions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller2_relacionar_id');
            $table->integer('orden')->nullable();
            $table->text('definicion')->nullable();
            $table->timestamps();
            
            $table->foreign('taller2_relacionar_id')
            ->references('id')
            ->on('taller2_relacionars')
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
        Schema::dropIfExists('taller2_relacionar_opcions');
    }
}
