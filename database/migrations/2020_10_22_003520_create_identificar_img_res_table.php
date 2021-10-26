<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentificarImgResTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identificar_img_res', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->unsignedbigInteger('identificar_id');
            $table->string('img')->nullable();
            $table->timestamps();

            $table->foreign('identificar_id')
            ->references('id')
            ->on('identificars')
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
        Schema::dropIfExists('identificar_img_res');
    }
}
