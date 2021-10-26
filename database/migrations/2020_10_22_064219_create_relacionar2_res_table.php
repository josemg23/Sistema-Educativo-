<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelacionar2ResTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relacionar2_res', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('relacionar2_id');
            $table->text('letra')->nullable();
            $table->text('definicion')->nullable();
            $table->timestamps();

            $table->foreign('relacionar2_id')
            ->references('id')
            ->on('relacionar2s')
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
        Schema::dropIfExists('relacionar2_res');
    }
}
