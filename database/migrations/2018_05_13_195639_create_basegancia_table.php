<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseganciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basegancia', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->integer('valor_inicia');
            $table->integer('valor_cierre');
            $table->integer('valor_ventas_cafeteria');
            $table->integer('valor_ventas_servicios');
            $table->integer('valor_salidas_remisiones');
            $table->integer('valor_entrada_remisiones'); 
            $table->timestamps();
            $table->unique('fecha');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basegancia');
    }
}
