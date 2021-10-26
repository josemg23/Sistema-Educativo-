<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallerAbreviaturaImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taller_abreviatura_imgs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_abreviatura_id');
            $table->string('col_a')->nullable();
            $table->string('col_b')->nullable();
            $table->timestamps();

            $table->foreign('taller_abreviatura_id')
            ->references('id')
            ->on('taller_abreviaturas')
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
        Schema::dropIfExists('taller_abreviatura_imgs');
    }
}
