<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->char('nombre', 100);
            $table->char('apellido', 100);
            $table->integer('tipo_identificacion_id')->unsigned();
            $table->char('identificacion', 100)->unique();
            $table->date('fecha_nacimiento')->nullable();
            $table->char('direccion', 100)->nullable();
            $table->char('telefono1', 100)->nullable();
            $table->char('telefono2', 100)->nullable();
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('tipo_identificacion_id')->references('id')->on('tipo_identificacions');
            $table->foreign('users_id')->references('id')->on('users');
        });

        DB::table('personas')->insert([
            'nombre' => 'Diego',
            'apellido' => 'Santiago',
            'tipo_identificacion_id'=>'1',
            'identificacion'=>'123456',
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
        Schema::drop('personas');
    }
}
