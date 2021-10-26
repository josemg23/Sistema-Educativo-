<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenIdeasDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_ideas_datos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('orden_idea_id');
            $table->longText('ideas')->nullable();
            $table->timestamps();

            $table->foreign('orden_idea_id')
            ->references('id')
            ->on('orden_ideas')
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
        Schema::dropIfExists('orden_ideas_datos');
    }
}
