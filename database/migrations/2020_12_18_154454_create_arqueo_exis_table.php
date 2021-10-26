<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArqueoExisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arqueo_exis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('arqueocaja_id');
            $table->longText('detalle');
            $table->string('e_debe')->nullable();
            $table->string('e_haber')->nullable();
            $table->timestamps();
            $table->foreign('arqueocaja_id')
            ->references('id')
            ->on('arqueocajas')
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
        Schema::dropIfExists('arqueo_exis');
    }
}
