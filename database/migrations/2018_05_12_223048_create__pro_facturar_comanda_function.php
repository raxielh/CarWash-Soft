<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProFacturarComandaFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE PROCEDURE ProFacturarComanda(IN `v_id` INTEGER(10))
                            BEGIN
                                DECLARE s_salida VARCHAR(20);


                                 delete FROM  `detallefactura` 
                                  WHERE `id`=v_id; 
                                  
                             

                                   delete FROM  `detallefactura` 
                                  where  `factura_id` =v_id;


                                
                                INSERT INTO 
                                  `factura`
                                (
                                  `id`,
                                  `persona_id`,
                                  `vehiculo_id`,
                                  `estado_id`,
                                  `observacion`,
                                  `users_id`,
                                  `created_at`,
                                  `updated_at`)
                                  SELECT 
                                  `c`.`id`,
                                  `c`.`persona_id`,
                                  `c`.`vehiculo_id`,
                                  `c`.`estado_id`,
                                  `c`.`observacion`,
                                  `c`.`users_id`,
                                  `c`.`created_at`,
                                  `c`.`updated_at`
                                FROM 
                                  `comandas` `c` 
                                  WHERE c.`id`=v_id; 

                                INSERT INTO 
                                  `detallefactura`
                                (
                                  `id`,
                                  `factura_id`,
                                  `concepto_id`,
                                  `cantidad`,
                                  `descuentos_id`,
                                  `descuento`,
                                  `valor`,
                                  `comision`,
                                  `impuesto`,
                                  `users_id`,
                                  `created_at`,
                                  `updated_at`) 

                                SELECT 
                                  `c`.`id`,
                                  `c`.`comanda_id`,
                                  `c`.`concepto_id`,
                                  `c`.`cantidad`,
                                  `c`.`descuentos_id`,
                                  `c`.`descuento`,
                                  `c`.`valor`,
                                  `c`.`comision`,
                                  `c`.`impuesto`,
                                  `c`.`users_id`,
                                  `c`.`created_at`,
                                  `c`.`updated_at`
                                FROM 
                                  `comanda_detalles` `c`
                                  WHERE c.`comanda_id`=v_id;

                                UPDATE   `comandas`  
                                    SET `estado_id`=3
                                    WHERE  `id`=v_id;

                                SELECT "Comanda Facturada";
                                
                            END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
