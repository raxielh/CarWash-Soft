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
            $table->string('codigo', 100);
            $table->integer('persona_id')->unsigned();
            $table->string('razon_social', 100);
            $table->string('nit', 100);
            $table->string('direccion', 100)->nullable();
            $table->string('telefono2', 100)->nullable();
            $table->string('telefono1', 100)->nullable();
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('users_id')->references('id')->on('users');
        });

        DB::table('proveedores')->insert([
            'codigo' => '00',
            'persona_id' => '1',
            'razon_social'=>'Brillancor',
            'nit'=>'00000-0',
            'users_id'=>'1',
        ]);

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
