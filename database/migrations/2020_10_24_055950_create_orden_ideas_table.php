<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_ideas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
            $table->longText('enunciado');
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
        Schema::dropIfExists('orden_ideas');
    }
}
