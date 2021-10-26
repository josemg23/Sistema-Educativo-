<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivo4sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activo4s', function (Blueprint $table) {
                $table->bigIncrements('id');
            $table->unsignedbigInteger('escribir_cuenta_id');
            $table->string('cuenta')->nullable();
            $table->timestamps();

            $table->foreign('escribir_cuenta_id')
            ->references('id')
            ->on('escribir_cuentas')
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
        Schema::dropIfExists('activo4s');
    }
}
