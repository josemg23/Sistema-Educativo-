<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeccionCompletarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leccion_completars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('leccion_id');
            $table->text('enunciado')->nullable();
            $table->text('enunciados')->nullable();
            $table->timestamps();
            $table->foreign('leccion_id')->references('id')->on('leccions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leccion_completars');
    }
}
