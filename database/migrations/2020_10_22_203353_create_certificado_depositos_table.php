<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificadoDepositosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificado_depositos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
            $table->longText('enunciado');
            $table->string('valor_inicial')->nullable();
            $table->string('caracter')->nullable();
            $table->string('beneficiario')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('plazo')->nullable();
            $table->string('fecha_de_emision')->nullable();
            $table->string('fecha_de_vencimiento')->nullable();
            $table->string('interes_anual')->nullable();
            $table->string('plazo_de_vencimiento')->nullable();
            $table->string('lugar_fecha_emision')->nullable();
            $table->string('firma_uno')->nullable();
            $table->string('firma_dos')->nullable();
            
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
        Schema::dropIfExists('certificado_depositos');
    }
}
