<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuloChequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulo_cheques', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
            // $table->longText('enunciado');
            $table->string('modulo')->nullable();
            $table->string('tipo_documento')->nullable();
            $table->string('tipo_cheque')->nullable();
            $table->text('banco')->nullable();
            $table->string('girador')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('n_cheque')->nullable();
            $table->string('cantidad_letra')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('fecha')->nullable();
            $table->string('firma')->nullable();
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
        Schema::dropIfExists('modulo_cheques');
    }
}
