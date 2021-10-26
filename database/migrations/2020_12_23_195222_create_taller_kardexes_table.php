<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallerKardexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taller_kardexes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_modulo_contable_id');
            $table->string('tipo')->nullable();
            $table->longText('enunciado')->nullable();
            $table->string('producto')->nullable();
            $table->text('transacciones')->nullable();
            $table->timestamps();
            
            $table->foreign('taller_modulo_contable_id')
            ->references('id')
            ->on('taller_modulo_contables')
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
        Schema::dropIfExists('taller_kardexes');
    }
}
