<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallerDiferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taller_diferencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('taller_id');
            $table->longText('enunciado');
            $table->string('img1')->nullable();
            $table->string('img2')->nullable();
            $table->string('descripcion1')->nullable();
            $table->string('descripcion2')->nullable();
            $table->timestamps();

            $table->foreign('taller_id')
            ->references('id')
            ->on('tallers')
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
        Schema::dropIfExists('taller_diferencias');
    }
}
