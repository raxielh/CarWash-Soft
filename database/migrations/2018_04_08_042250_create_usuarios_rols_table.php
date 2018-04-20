<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuariosRolsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_rols', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('roles_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('roles_id')->references('id')->on('roles');
            $table->foreign('users_id')->references('id')->on('users');
        });

        DB::table('usuarios_rols')->insert([
            'roles_id' => '1',
            'users_id' => '1',
        ]);

        DB::table('usuarios_rols')->insert([
            'roles_id' => '1',
            'users_id' => '2',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuarios_rols');
    }
}
