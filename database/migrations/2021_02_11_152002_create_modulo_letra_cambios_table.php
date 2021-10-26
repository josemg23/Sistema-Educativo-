<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuloLetraCambiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulo_letra_cambios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
            // $table->longText('enunciado');
            $table->string('modulo')->nullable();
            $table->string('tipo_documento')->nullable();
            $table->string('vencimiento')->nullable();
            $table->string('numero')->nullable();
            $table->string('por')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('fecha')->nullable();
            $table->string('orden_de')->nullable();
            $table->string('de')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('interes')->nullable();
            $table->string('desde')->nullable();
            $table->string('direccion')->nullable();
            $table->string('ciudad2')->nullable();
            $table->string('atentamente')->nullable();
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
        Schema::dropIfExists('modulo_letra_cambios');
    }
}
