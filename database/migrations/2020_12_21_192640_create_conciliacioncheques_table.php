<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConciliacionchequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conciliacioncheques', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('conciliacionbancaria_id');
            $table->string('fecha')->nullable();
            $table->longText('detalle')->nullable();
            $table->string('saldo')->nullable();
            $table->timestamps();
            $table->foreign('conciliacionbancaria_id')
            ->references('id')
            ->on('conciliacionbancarias')
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
        Schema::dropIfExists('conciliacioncheques');
    }
}
