<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoConceptosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_conceptos', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('descripcion');
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('users_id')->references('id')->on('users');
        });

        DB::table('tipo_conceptos')->insert([
            'descripcion' => 'Combo',
            'users_id' => '1',
        ]);

        DB::table('tipo_conceptos')->insert([
            'descripcion' => 'Producto',
            'users_id' => '1',
        ]);

        DB::table('tipo_conceptos')->insert([
            'descripcion' => 'Gasto',
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
        Schema::drop('tipo_conceptos');
    }
}
