<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDescuentosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descuentos', function (Blueprint $table) {
            $table->increments('id');
            $table->char('codigo', 100);
            $table->char('descripcion', 100);
            $table->integer('porcentaje');
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('users_id')->references('id')->on('users');
        });

        DB::table('descuentos')->insert([
            'codigo' => '0',
            'descripcion' => '0',
            'porcentaje' => '0',
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
        Schema::drop('descuentos');
    }
}
