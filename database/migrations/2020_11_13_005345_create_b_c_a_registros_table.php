<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBCARegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_c_a_registros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('balance_ajustado_id');
            $table->unsignedbigInteger('cuenta_id');
            $table->text('cuenta')->nullable();
            $table->string('debe')->nullable();
            $table->string('haber')->nullable();
            $table->timestamps();

            $table->foreign('balance_ajustado_id')
            ->references('id')
            ->on('balance_ajustados')
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
        Schema::dropIfExists('b_c_a_registros');
    }
}
