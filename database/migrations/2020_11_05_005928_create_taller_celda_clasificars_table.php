<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallerCeldaClasificarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taller_celda_clasificars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_celda_id');
            $table->text('clasificados')->nullable();
            $table->timestamps();

            $table->foreign('taller_celda_id')
            ->references('id')
            ->on('taller_celdas')
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
        Schema::dropIfExists('taller_celda_clasificars');
    }
}
