<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('instituto_id')->nullable();
            $table->unsignedBigInteger('distribucionmacu_id')->nullable();
            $table->unsignedBigInteger('nivel_id')->nullable();
          
            $table->string('cedula');
            $table->string('name');
            $table->string('apellido');
            $table->string('domicilio')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->unique();
            $table->string('password');    
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('estado',['on','off'])->nullable();
            $table->rememberToken();
            $table->timestamps();
    
            $table->foreign('instituto_id')->references('id')->on('institutos')->onDelete('set null');
            $table->foreign('distribucionmacu_id')->references('id')->on('distribucionmacus')->onDelete('set null');
            $table->foreign('nivel_id')->references('id')->on('nivels')->onDelete('set null');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}