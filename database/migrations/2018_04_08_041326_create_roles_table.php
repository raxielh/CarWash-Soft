<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->char('descripcion', 100)->unique();
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('users_id')->references('id')->on('users');
        });

        DB::table('roles')->insert([
            'descripcion' => 'Super Root',
            'users_id' => '1',
        ]);

        DB::table('roles')->insert([
            'descripcion' => 'Administrador',
            'users_id' => '1',
        ]);

        DB::table('roles')->insert([
            'descripcion' => 'Trabajador',
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
        Schema::drop('roles');
    }
}
