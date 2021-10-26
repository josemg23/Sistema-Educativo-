<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbreviaturaResTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abreviatura_res', function (Blueprint $table) {
              $table->bigIncrements('id');
            $table->unsignedbigInteger('abreviatura_id');
            $table->string('col_a')->nullable();
            $table->string('col_a_res')->nullable();
            $table->string('col_b')->nullable();
            $table->string('col_b_res')->nullable();
            $table->timestamps();

            $table->foreign('abreviatura_id')
            ->references('id')
            ->on('abreviaturas')
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
        Schema::dropIfExists('abreviatura_res');
    }
}
