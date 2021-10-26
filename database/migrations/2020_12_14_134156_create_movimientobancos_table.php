<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientobancosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientobancos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('librobanco_id');
            $table->string('fecha')->nullable();
            $table->string('detalle')->nullable();
            $table->string('cheque')->nullable();
            $table->string('debe')->nullable();
            $table->string('haber')->nullable();
            $table->string('saldo')->nullable();
            $table->timestamps();

            $table->foreign('librobanco_id')
            ->references('id')
            ->on('librobancos')
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
        Schema::dropIfExists('movimientobancos');
    }
}
