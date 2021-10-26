<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTallerSubrayarOpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taller_subrayar_ops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_subrayars_id');
            $table->longText('concepto')->nullable();
            $table->longText('respuesta')->nullable();
            $table->string('alternativas')->nullable();
            $table->timestamps();
            
            $table->foreign('taller_subrayars_id')
            ->references('id')
            ->on('taller_subrayars')
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
        Schema::dropIfExists('taller_subrayar_ops');
    }
}
