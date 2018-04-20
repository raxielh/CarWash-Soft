<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstadoComandasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_comandas', function (Blueprint $table) {
            $table->increments('id');
            $table->char('descripcion', 100);
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('users_id')->references('id')->on('users');
        });

        DB::table('estado_comandas')->insert([
            'descripcion' => 'Activa',
            'users_id' => '1',
        ]);

        DB::table('estado_comandas')->insert([
            'descripcion' => 'Inactiva',
            'users_id' => '1',
        ]);

        DB::table('estado_comandas')->insert([
            'descripcion' => 'Facturada',
            'users_id' => '1',
        ]);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('estado_comandas');
    }
}
