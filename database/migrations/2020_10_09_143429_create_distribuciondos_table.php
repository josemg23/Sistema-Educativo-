<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistribuciondosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribuciondos', function (Blueprint $table) {
            $table->bigIncrements('id');
         
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('instituto_id');
            $table->unsignedBigInteger('materia_id');
            $table->enum('estado',['on','off'])->nullable();
            $table->timestamps();
           
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('instituto_id')->references('id')->on('institutos')->onDelete('cascade');
            $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');
        });

            Schema::create('distribuciondo_nivel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('distribuciondo_id');
            $table->unsignedBigInteger('nivel_id');
            $table->string('nivel_nombre')->nullable();
                     
            $table->timestamps();

            $table->foreign('distribuciondo_id')->references('id')->on('distribuciondos')->onDelete('cascade'); 
            $table->foreign('nivel_id')->references('id')->on('nivels')->onDelete('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distribuciondos');
        Schema::dropIfExists('distribuciondo_nivel');
        
    }
}
