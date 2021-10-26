<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKFRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_f_registros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('kardex_fifo_id');
            $table->text('fecha')->nullable();
            $table->text('movimiento')->nullable();
            $table->string('no_registro')->nullable();
            $table->timestamps();

             $table->foreign('kardex_fifo_id')
            ->references('id')
            ->on('kardex_fifos')
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
        Schema::dropIfExists('k_f_registros');
    }
}
