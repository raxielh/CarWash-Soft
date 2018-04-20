<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoIdentificacionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_identificacions', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('descripcion');
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('users_id')->references('id')->on('users');
        });

        DB::table('tipo_identificacions')->insert([
            'descripcion' => 'CC',
            'users_id' => '1',
        ]);

        DB::table('tipo_identificacions')->insert([
            'descripcion' => 'TI',
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
        Schema::drop('tipo_identificacions');
    }
}
