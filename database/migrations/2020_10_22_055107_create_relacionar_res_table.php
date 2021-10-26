<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelacionarResTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relacionar_res', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('relacionar_id');
            $table->longText('enunciado')->nullable();
            $table->string('img')->nullable();
            $table->string('definicion')->nullable();
            $table->string('definicion_aleatoria')->nullable();
            $table->timestamps();


            $table->foreign('relacionar_id')
            ->references('id')
            ->on('relacionars')
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
        Schema::dropIfExists('relacionar_res');
    }
}
