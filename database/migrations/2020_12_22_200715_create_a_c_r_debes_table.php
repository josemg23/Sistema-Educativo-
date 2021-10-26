<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateACRDebesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_c_r_debes', function (Blueprint $table) {
              $table->bigIncrements('id');
            $table->unsignedbigInteger('a_c_registro_id');
            $table->unsignedbigInteger('cuenta_id');
            $table->string('nom_cuenta');
            $table->string('saldo')->nullable();
            $table->date('fecha')->nullable();
            $table->timestamps();


            $table->foreign('a_c_registro_id')
            ->references('id')
            ->on('a_c_registros')
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
        Schema::dropIfExists('a_c_r_debes');
    }
}
