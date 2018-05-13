<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRemisionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remisions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion', 100)->nullable();
            $table->integer('persona_id')->unsigned();
            $table->integer('proveedor_id')->unsigned();
            $table->integer('concepto_id')->unsigned();
            $table->integer('tipo_remision_id')->unsigned();
            $table->date('fecha', 100);
            $table->integer('valor');
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->foreign('concepto_id')->references('id')->on('conceptos');
            $table->foreign('tipo_remision_id')->references('id')->on('tipo_remision');
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
        Schema::drop('remisions');
    }
}
