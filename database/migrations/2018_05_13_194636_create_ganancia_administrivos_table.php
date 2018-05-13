<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGananciaAdministrivosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ganancia_administrivos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('valorini');
            $table->integer('valorfin');
            $table->integer('porcenganancia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ganancia_administrivos');
    }
}
