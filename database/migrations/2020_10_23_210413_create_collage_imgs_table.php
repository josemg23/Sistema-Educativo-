<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollageImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collage_imgs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('collage_id');
            $table->string('url_img')->nullable();
            $table->timestamps();

            $table->foreign('collage_id')
            ->references('id')
            ->on('collages')
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
        Schema::dropIfExists('collage_imgs');
    }
}
