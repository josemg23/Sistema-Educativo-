<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMGRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_g_registros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('mayor_general_id');
            $table->unsignedbigInteger('cuenta_id')->nullable();
            $table->text('cuenta')->nullable();
            $table->string('no_registro')->nullable();
            $table->string('total_debe')->nullable();
            $table->string('total_haber')->nullable();
            $table->string('total_saldo')->nullable();
            $table->timestamps();

             $table->foreign('mayor_general_id')
            ->references('id')
            ->on('mayor_generals')
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
        Schema::dropIfExists('m_g_registros');
    }
}
