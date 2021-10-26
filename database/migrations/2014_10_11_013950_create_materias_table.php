<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('instituto_id')->nullable();
            $table->string('nombre');
            $table->string('slug');
            $table->string('descripcion');
            $table->enum('estado',['on','off'])->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('materias');
    }
}
