<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseadpersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baseadpersonal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('persona_id')->unsigned();
            $table->date('fecha');
            $table->integer('porcentaje')->unsigned();
            $table->integer('valor');
            $table->integer('tipopersonal_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('tipopersonal_id')->references('id')->on('tipopersonal');
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
        Schema::dropIfExists('baseadpersonal');
    }
}
