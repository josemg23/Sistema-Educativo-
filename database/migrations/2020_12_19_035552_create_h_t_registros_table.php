<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHTRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_t_registros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('hoja_trabajo_id');
            $table->unsignedbigInteger('cuenta_id');
            $table->text('cuenta')->nullable();
            $table->string('bc_debe')->nullable();
            $table->string('bc_haber')->nullable();
            $table->string('ajuste_debe')->nullable();
            $table->string('ajuste_haber')->nullable();
            $table->string('ba_debe')->nullable();
            $table->string('ba_haber')->nullable();
            $table->string('er_debe')->nullable();
            $table->string('er_haber')->nullable();
            $table->string('bg_debe')->nullable();
            $table->string('bg_haber')->nullable();
            $table->timestamps();

            $table->foreign('hoja_trabajo_id')
            ->references('id')
            ->on('hoja_trabajos')
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
        Schema::dropIfExists('h_t_registros');
    }
}
