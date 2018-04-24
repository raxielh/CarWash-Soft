<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVehiculosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('persona_id')->unsigned();
            $table->char('placa')->unique(100);
            $table->char('modelo', 100)->nullable();
            $table->char('color', 100)->nullable();
            $table->integer('users_id')->unsigned();
            $table->integer('marcas_id')->unsigned();
            $table->integer('lineas_id')->unsigned();
            $table->timestamps();
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('marcas_id')->references('id')->on('marcas');
            $table->foreign('lineas_id')->references('id')->on('lineas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vehiculos');
    }
}
