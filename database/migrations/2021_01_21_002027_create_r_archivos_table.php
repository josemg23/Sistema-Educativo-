<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_archivos', function (Blueprint $table) {
            $table->unsignedbigInteger('respuesta_archivo_id');
            $table->text('nombre')->nullable();
            $table->string('urlarchivo')->nullable();
            $table->string('extension')->nullable();
            $table->timestamps();

            $table->foreign('respuesta_archivo_id')
            ->references('id')
            ->on('respuesta_archivos')
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
        Schema::dropIfExists('r_archivos');
    }
}
