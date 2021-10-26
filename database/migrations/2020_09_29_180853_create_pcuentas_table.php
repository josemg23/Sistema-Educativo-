<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcuentas', function (Blueprint $table) {
            $table->string('nombre');
            $table->bigIncrements('id');
            $table->string('tpcuenta');
            $table->boolean('porcentual')->nullable();
            $table->float('porcentaje')->nullable();
            $table->enum('estado',['on','off'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pcuentas');
    }
}
