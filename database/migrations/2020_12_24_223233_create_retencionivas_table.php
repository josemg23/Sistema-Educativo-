<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetencionivasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retencionivas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('taller_id');
            $table->unsignedbigInteger('user_id');
            $table->string('nombre')->nullable();
            $table->string('fecha')->nullable();
            $table->string('contribuyente')->nullable();
            $table->string('ruc')->nullable();
            $table->string('sumac_base')->nullable();
            $table->string('sumac_reten')->nullable();
            $table->string('sumac_ivac')->nullable();
            $table->string('sumac_10')->nullable();
            $table->string('sumac_20')->nullable();
            $table->string('sumac_30')->nullable();
            $table->string('sumac_70')->nullable();
            $table->string('sumac_100')->nullable();
            $table->string('sumav_base')->nullable();
            $table->string('sumav_reten')->nullable();
            $table->string('sumav_ivav')->nullable();
            $table->string('sumav_10')->nullable();
            $table->string('sumav_20')->nullable();
            $table->string('sumav_30')->nullable();
            $table->string('sumav_70')->nullable();
            $table->string('sumav_100')->nullable();
            $table->string('t_ivacompra')->nullable();
            $table->string('t_ivaventa')->nullable();
            $table->string('t_reten')->nullable();
            $table->string('result_iva')->nullable();
            $table->string('total')->nullable();
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
        Schema::dropIfExists('retencionivas');
    }
}
