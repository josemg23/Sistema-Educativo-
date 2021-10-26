<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHojaTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoja_trabajos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
            $table->string('nombre');
            $table->string('bc_total_debe')->nullable();
            $table->string('bc_total_haber')->nullable();
            $table->string('ajuste_total_debe')->nullable();
            $table->string('ajuste_total_haber')->nullable();
            $table->string('ba_total_debe')->nullable();
            $table->string('ba_total_haber')->nullable();
            $table->string('er_total_debe')->nullable();
            $table->string('er_total_haber')->nullable();
            $table->string('bg_total_debe')->nullable();
            $table->string('bg_total_haber')->nullable();
            $table->timestamps();
            
            $table->foreign('taller_id')
            ->references('id')
            ->on('tallers')
            ->onDelete('cascade');

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('hoja_trabajos');
    }
}
