<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLavadosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lavados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('comanda_id')->unsigned();
            $table->integer('equipo_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('comanda_id')->references('id')->on('comandas');
            $table->foreign('equipo_id')->references('id')->on('equipos');
            $table->foreign('users_id')->references('id')->on('users');
            $table->unique(['comanda_id','equipo_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lavados');
    }
}
