<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbreviaturaEditorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abreviatura_editorials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
            $table->longText('enunciado');
            $table->string('abreviatura1')->nullable();
            $table->string('abreviatura2')->nullable();
            $table->string('abreviatura3')->nullable();
            $table->string('abreviatura4')->nullable();
            $table->string('abreviatura5')->nullable();
            $table->string('abreviatura6')->nullable();
            $table->string('abreviatura7')->nullable();
            $table->string('abreviatura8')->nullable();
            $table->string('abreviatura9')->nullable();
            $table->string('abreviatura10')->nullable();
            $table->string('abreviatura11')->nullable();
            $table->timestamps();
            
            $table->foreign('taller_id')
            ->references('id')
            ->on('tallers')
            ->onDelete('cascade');

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('abreviatura_editorials');
    }
}
