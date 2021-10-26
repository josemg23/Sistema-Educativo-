<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientoprovisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientoprovisions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('provisionsocial_id');      
            $table->string('nombre_em');
            $table->string('dias')->nullable();
            $table->string('v_recibido')->nullable();
            $table->string('d_tercero')->nullable();
            $table->string('d_cuarto')->nullable();
            $table->string('vacaciones')->nullable();
            $table->string('f_reserva')->nullable();
            $table->timestamps();

            $table->foreign('provisionsocial_id')
            ->references('id')
            ->on('provisionsocials')
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
        Schema::dropIfExists('movimientoprovisions');
    }
}
