<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistribucionmacusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribucionmacus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('curso_id');  
            $table->unsignedBigInteger('instituto_id');
          
            $table->enum('estado',['on','off'])->nullable();
            $table->timestamps();
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
          
            $table->foreign('instituto_id')->references('id')->on('institutos')->onDelete('cascade');
          
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distribucionmacus');
    }
}
