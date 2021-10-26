<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlternativaCorrectaResTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alternativa_correcta_res', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('alternativa_correcta_id');
            $table->longText('concepto')->nullable();
            $table->longText('respuesta')->nullable();
            $table->timestamps();

            $table->foreign('alternativa_correcta_id')
            ->references('id')
            ->on('alternativa_correctas')
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
        Schema::dropIfExists('alternativa_correcta_res');
    }
}
