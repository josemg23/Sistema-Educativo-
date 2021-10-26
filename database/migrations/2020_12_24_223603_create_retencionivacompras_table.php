<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetencionivacomprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retencionivacompras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('retencioniva_id');
            $table->string('fecha_c')->nullable();
            $table->string('detalle')->nullable();
            $table->string('proveedor')->nullable();
            $table->string('base_im')->nullable();
            $table->string('porcentaje')->nullable();
            $table->string('v_retenido')->nullable();
            $table->string('iva')->nullable();
            $table->string('ret_10')->nullable();
            $table->string('ret_20')->nullable();
            $table->string('ret_30')->nullable();
            $table->string('ret_70')->nullable();
            $table->string('ret_100')->nullable();
            
            $table->timestamps();
            $table->foreign('retencioniva_id')
            ->references('id')
            ->on('retencionivas')
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
        Schema::dropIfExists('retencionivacompras');
    }
}
