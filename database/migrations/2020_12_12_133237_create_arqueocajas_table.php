<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArqueocajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arqueocajas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
            $table->string('totaldebe')->nullable();
            $table->string('totalhaber')->nullable();
            $table->string('saldo_ctcaja')->nullable();
            $table->string('saldo_arqueocaja')->nullable();
            $table->string('select_resultado')->nullable();
            $table->string('select_valor')->nullable();
            $table->string('cuenta1')->nullable();
            $table->string('cuenta2')->nullable();
            $table->string('valor1')->nullable();
            $table->string('valor2')->nullable();

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
        Schema::dropIfExists('arqueocajas');
    }
}
