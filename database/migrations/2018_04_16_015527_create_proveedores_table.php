<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProveedoresTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->increments('id');
            $table->char('codigo', 100);
            $table->integer('persona_id')->unsigned();
            $table->char('razon_social', 100);
            $table->char('nit', 100);
            $table->char('direccion', 100);
            $table->char('telefono2', 100);
            $table->char('telefono1', 100);
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('proveedores');
    }
}
