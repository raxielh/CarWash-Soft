<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGananciaAdminTable extends Migration
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
        Schema::dropIfExists('ganancia_administrivos');
    }
}
