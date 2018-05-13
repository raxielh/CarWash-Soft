<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfiguracionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('concepto_admin_gasto')->unsigned();
            $table->integer('concepto_lavador_gasto')->unsigned();
            $table->timestamps();
            $table->foreign('concepto_admin_gasto')->references('id')->on('conceptos');
            $table->foreign('concepto_lavador_gasto')->references('id')->on('conceptos');
        });

        DB::table('configuracions')->insert([
            'concepto_admin_gasto' => '1',
            'concepto_lavador_gasto' => '2',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('configuracions');
    }
}
