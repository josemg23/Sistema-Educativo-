<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistribucionmacuMateriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribucionmacu_materia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('distribucionmacu_id');
            $table->unsignedBigInteger('materia_id');
                     
            $table->timestamps();

            $table->foreign('distribucionmacu_id')->references('id')->on('distribucionmacus')->onDelete('cascade'); 
            $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distribucionmacu_materia');
    }
}
