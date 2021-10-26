<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBGPasivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_g_pasivos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('balance_general_id');
            $table->string('fecha')->nullable();
            $table->string('cuenta')->nullable();
            $table->unsignedbigInteger('cuenta_id')->nullable();
            $table->string('saldo')->nullable();
            $table->string('tipo')->nullable();
            $table->timestamps();

            $table->foreign('balance_general_id')
            ->references('id')
            ->on('balance_generals')
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
        Schema::dropIfExists('b_g_pasivos');
    }
}
