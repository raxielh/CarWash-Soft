<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFncalculacierre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE FUNCTION FnCalculaCierre(`v_fecha` DATE) RETURNS VARCHAR(1000) CHARSET latin1 BEGIN
 

                         declare  s_valor_inicia INTEGER(11);
                         declare  s_valor_cierre INTEGER(11);
                         declare  s_valor_ventas_cafeteria INTEGER(11);
                         declare  s_valor_ventas_servicios INTEGER(11);
                         declare  s_valor_salidas_remisiones INTEGER(11);
                         declare  s_valor_entrada_remisiones INTEGER(11);


                        SELECT  b.valor_cierre 
                        into s_valor_inicia
                        FROM   basegancia b
                        where b.fecha in 
                        (
                          SELECT max( b2.fecha )
                          FROM   basegancia b2
                          where b2.fecha < v_fecha
                        )
                        ;

                        if (s_valor_inicia is null) then
                           select 0
                           into s_valor_inicia ;
                        end if;



                         select round(sum(
                        (df.cantidad*df.valor)
                        )) as valor_comi
                        into s_valor_ventas_servicios
                        from factura f,
                             detallefactura df,
                             conceptos c,
                             tipo_conceptos tc
                        where f.id = df.factura_id
                        and df.concepto_id=c.id
                        and c.tipo_conceptos_id=tc.id
                        and f.estado_id=1
                        AND STR_TO_DATE(DATE_FORMAT(f.created_at, "%d/%m/%Y"),  "%d/%m/%Y") = v_fecha
                        and tc.id in (3,1);   


                        if (s_valor_ventas_servicios is null) then
                           select 0
                           into s_valor_ventas_servicios ;
                        end if;


                         select round(sum(
                        (df.cantidad*df.valor)
                        )) as valor_comi
                        into s_valor_ventas_cafeteria
                        from factura f,
                             detallefactura df,
                             conceptos c,
                             tipo_conceptos tc
                        where f.id = df.factura_id
                        and df.concepto_id=c.id
                        and c.tipo_conceptos_id=tc.id
                        and f.estado_id=1
                        AND STR_TO_DATE(DATE_FORMAT(f.created_at, "%d/%m/%Y"),  "%d/%m/%Y") = v_fecha
                        and tc.id in (2); 


                        if (s_valor_ventas_cafeteria is null) then
                           select 0
                           into s_valor_ventas_cafeteria ;
                        end if;

                        SELECT sum(r.valor)
                        into s_valor_entrada_remisiones
                        FROM   remisions  r
                        where  r.fecha=v_fecha
                        and r.tipo_remision_id=1 
                        ;

                        if (s_valor_entrada_remisiones is null) then
                           select 0
                           into s_valor_entrada_remisiones ;
                        end if;

                        SELECT sum(r.valor)
                        into s_valor_salidas_remisiones
                        FROM   remisions  r
                        where  r.fecha=v_fecha
                        and r.tipo_remision_id=2
                        ;
                        if (s_valor_salidas_remisiones is null) then
                           select 0
                           into s_valor_salidas_remisiones ;
                        end if;

                        delete from basegancia
                        where fecha=v_fecha;

                        select (s_valor_inicia+s_valor_entrada_remisiones+s_valor_ventas_cafeteria+s_valor_ventas_servicios)-(s_valor_salidas_remisiones)
                        into s_valor_cierre;

                        INSERT INTO 
                          basegancia
                        (
                          fecha,
                          valor_inicia,
                          valor_cierre,
                          valor_ventas_cafeteria,
                          valor_ventas_servicios,
                          valor_salidas_remisiones,
                          valor_entrada_remisiones,
                          created_at,
                          updated_at) 
                        VALUE (
                          v_fecha,
                          s_valor_inicia,
                          s_valor_cierre,
                          s_valor_ventas_cafeteria,
                          s_valor_ventas_servicios,
                          s_valor_salidas_remisiones,
                          s_valor_entrada_remisiones,
                          now(),
                          now());

                         return "Cierre cargado satisfactoriamente";
                        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
