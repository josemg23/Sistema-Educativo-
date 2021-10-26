<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartidaDobleRegisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partida_doble_regis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('partida_doble_id');
            $table->text('cuenta')->nullable();
            $table->text('total_debe')->nullable();
            $table->text('total_haber')->nullable();
            $table->timestamps();

            $table->foreign('partida_doble_id')
            ->references('id')
            ->on('partida_dobles')
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
        Schema::dropIfExists('partida_doble_regis');
    }
}
