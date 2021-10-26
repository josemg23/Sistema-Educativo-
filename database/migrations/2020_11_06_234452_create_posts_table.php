<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('instituto_id')->nullable();
            $table->unsignedBigInteger('materia_id')->nullable();
            $table->unsignedBigInteger('nivel_id')->nullable();
            $table->unsignedBigInteger('distribucionmacu_id')->nullable();
            $table->string('nombre');
            $table->mediumText('abstract');
            $table->text('body');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('instituto_id')->references('id')->on('institutos')->onDelete('cascade');
            $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');
            $table->foreign('nivel_id')->references('id')->on('nivels')->onDelete('cascade');
            $table->foreign('distribucionmacu_id')->references('id')->on('distribucionmacus')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
