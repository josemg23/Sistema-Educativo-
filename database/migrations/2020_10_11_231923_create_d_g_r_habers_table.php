<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDGRHabersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_g_r_habers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('d_g_registro_id');
            $table->unsignedbigInteger('cuenta_id');
            $table->string('nom_cuenta')->nullable();
            $table->string('saldo')->nullable();
            $table->timestamps();


            $table->foreign('d_g_registro_id')
            ->references('id')
            ->on('d_g_registros')
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
        Schema::dropIfExists('d_g_r_habers');
    }
}
