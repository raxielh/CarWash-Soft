<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEquipoPersonasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_personas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('equipo_id')->unsigned();
            $table->integer('persona_id')->unsigned();
            $table->integer('estado_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('equipo_id')->references('id')->on('equipos');
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('users_id')->references('id')->on('users');
            $table->unique(['equipo_id','persona_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('equipo_personas');
    }
}
