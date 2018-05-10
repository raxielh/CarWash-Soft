<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallefacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallefactura', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('factura_id')->unsigned();
            $table->integer('concepto_id')->unsigned();
            $table->integer('cantidad')->unsigned();
            $table->integer('descuentos_id')->unsigned();
            $table->char('valor', 100);
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('factura_id')->references('id')->on('factura');
            $table->foreign('concepto_id')->references('id')->on('conceptos');
            $table->foreign('descuentos_id')->references('id')->on('descuentos');
            $table->foreign('users_id')->references('id')->on('users');
            $table->unique(['comanda_id','concepto_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detallefactura');
    }
}
