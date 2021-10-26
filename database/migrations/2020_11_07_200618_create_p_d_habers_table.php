<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePDHabersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_d_habers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('partida_doble_regi_id');
            $table->text('valor')->nullable();
            $table->timestamps();

            $table->foreign('partida_doble_regi_id')
            ->references('id')
            ->on('partida_doble_regis')
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
        Schema::dropIfExists('p_d_habers');
    }
}
