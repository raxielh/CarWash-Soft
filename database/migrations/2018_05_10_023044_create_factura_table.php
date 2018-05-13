<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->integer('persona_id')->unsigned();
            $table->integer('vehiculo_id')->unsigned();
            $table->integer('estado_id')->unsigned();
            $table->string('observacion', 100)->nullable();
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->foreign('estado_id')->references('id')->on('estado_comandas');
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
        Schema::dropIfExists('factura');
    }
}
