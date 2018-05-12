<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoRemisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_remision', function (Blueprint $table) {
            $table->increments('id');
            $table->char('descripcion', 100);
            $table->timestamps();
        });

        DB::table('tipo_remision')->insert([
            'descripcion' => 'Diaria'
        ]);
        
        DB::table('tipo_remision')->insert([
            'descripcion' => 'Mensual'
        ]);
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_remision');
    }
}
