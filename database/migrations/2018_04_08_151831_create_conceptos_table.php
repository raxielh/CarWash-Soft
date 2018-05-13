<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConceptosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conceptos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 100)->unique();
            $table->mediumText('descripcion');
            $table->integer('tipo_conceptos_id')->unsigned();
            $table->integer('comision')->default(0);
            $table->integer('impuesto')->default(0);
            $table->integer('estado_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->timestamps();
            $table->foreign('tipo_conceptos_id')->references('id')->on('tipo_conceptos');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('users_id')->references('id')->on('users');
        });

        DB::table('conceptos')->insert([
            'codigo' => '000-1',
            'descripcion' => 'Gasto Trabajador',
            'tipo_conceptos_id' => '4',
            'estado_id' => '1',
            'users_id' => '1',
        ]);

        DB::table('conceptos')->insert([
            'codigo' => '000-2',
            'descripcion' => 'Gasto Lavador',
            'tipo_conceptos_id' => '4',
            'estado_id' => '1',
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
        Schema::drop('conceptos');
    }
}
