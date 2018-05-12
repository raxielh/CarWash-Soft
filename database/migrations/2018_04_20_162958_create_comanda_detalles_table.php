<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComandaDetallesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comanda_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('comanda_id')->unsigned();
            $table->integer('concepto_id')->unsigned();
            $table->integer('cantidad')->unsigned();
            $table->integer('descuentos_id')->unsigned();
            $table->char('valor', 100);
            $table->integer('comision');
            $table->integer('impuesto');
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('comanda_id')->references('id')->on('comandas');
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
        Schema::drop('comanda_detalles');
    }
}
