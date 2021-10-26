<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallerIdenTransaOpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taller_iden_transa_ops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_iden_transa_id');
            $table->longText('enunciado')->nullable();
            $table->timestamps();
            
            $table->foreign('taller_iden_transa_id')
            ->references('id')
            ->on('taller_iden_transas')
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
        Schema::dropIfExists('taller_iden_transa_ops');
    }
}
