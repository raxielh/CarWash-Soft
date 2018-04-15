<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGaleriaVehiculosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeria_vehiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehiculo_id')->unsigned();
            $table->char('foto', 199);
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
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
        Schema::drop('galeria_vehiculos');
    }
}
