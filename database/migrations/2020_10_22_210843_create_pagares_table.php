<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagares', function (Blueprint $table) {
         $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
            $table->longText('enunciado');
            $table->string('cantidad')->nullable();
            $table->string('resp1')->nullable();
            $table->string('resp2')->nullable();
            $table->string('resp3')->nullable();
            $table->string('resp4')->nullable();
            $table->string('resp5')->nullable();
            $table->string('resp6')->nullable();
            $table->string('resp7')->nullable();
            $table->string('resp8')->nullable();
            $table->string('resp9')->nullable();
            $table->string('resp10')->nullable();
            $table->string('resp11')->nullable();
            $table->string('resp12')->nullable();
            $table->string('resp13')->nullable();
            $table->string('resp14')->nullable();
            $table->string('resp15')->nullable();
            $table->string('resp16')->nullable();
            $table->string('resp17')->nullable();
            $table->string('resp18')->nullable();
            $table->string('resp19')->nullable();
            $table->string('resp20')->nullable();
            $table->string('resp21')->nullable();
            $table->string('resp22')->nullable();
            $table->string('resp23')->nullable();
            $table->string('resp24')->nullable();
            $table->string('resp25')->nullable();
            $table->string('resp26')->nullable();
            $table->string('resp27')->nullable();
            $table->string('resp28')->nullable();
            $table->string('resp29')->nullable();
            $table->string('resp30')->nullable();
            $table->string('resp31')->nullable();
            $table->string('resp32')->nullable();
            $table->string('resp33')->nullable();
            $table->string('resp34')->nullable();
            $table->string('resp35')->nullable();
            $table->string('fecha_vencimiento')->nullable();
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
        Schema::dropIfExists('pagares');
    }
}
