<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBCRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_c_registros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('balance_comprobacion_id');
            $table->unsignedbigInteger('cuenta_id');
            $table->text('cuenta')->nullable();
            $table->string('suma_debe')->nullable();
            $table->string('suma_haber')->nullable();
            $table->string('saldo_debe')->nullable();
            $table->string('saldo_haber')->nullable();
            $table->timestamps();

            $table->foreign('balance_comprobacion_id')
            ->references('id')
            ->on('balance_comprobacions')
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
        Schema::dropIfExists('b_c_registros');
    }
}
