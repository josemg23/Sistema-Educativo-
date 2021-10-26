<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRAEnunciadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_a_enunciados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_r_alternativa_id');
            $table->text('enunciado')->nullable();
            $table->timestamps();

            $table->foreign('taller_r_alternativa_id')
            ->references('id')
            ->on('taller_r_alternativas')
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
        Schema::dropIfExists('r_a_enunciados');
    }
}
