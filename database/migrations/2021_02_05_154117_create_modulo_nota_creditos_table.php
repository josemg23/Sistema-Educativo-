<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuloNotaCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulo_nota_creditos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
            $table->string('modulo')->nullable();
            $table->string('tipo_documento')->nullable();
            $table->string('razon_social')->nullable();
            $table->text('fecha_emision')->nullable();
            $table->string('ruc')->nullable();
            $table->string('comprobante')->nullable();
            $table->string('razon_modificacion')->nullable();
            $table->string('emision')->nullable();
            $table->longText('datos')->nullable();
            $table->longText('totales')->nullable();
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
        Schema::dropIfExists('modulo_nota_creditos');
    }
}
