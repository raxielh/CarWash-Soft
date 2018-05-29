<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFncalculacomisionlava extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE FUNCTION FnCalculaComisionLava (`v_fecha` DATE) RETURNS VARCHAR(1000) CHARSET latin1 BEGIN

   delete from `baseadpersonal`
                   where fecha=v_fecha
                   and tipopersonal_id=2;
                   
                   
                   
 delete from remisions
where fecha=v_fecha
and concepto_id in 
(
  select c.concepto_lavador_gasto
 from configuracions c
);        
                   
                   
 INSERT INTO 
  `baseadpersonal`
(
  `persona_id`,
  `fecha`,
  `valor`,
  `tipopersonal_id`)
  
  
select pe.`id`, 
STR_TO_DATE(DATE_FORMAT(f.`created_at`, "%d/%m/%Y"),  "%d/%m/%Y") as fecha,
sum(
(df.`cantidad`*df.`valor`)*(c.`comision`/100)
) as valor_comi,2 as tipoper
from factura f,
     `detallefactura` df,
     `conceptos` c,
     `tipo_conceptos` `tc`,
     lavados l,
     `equipo_personas` ep,
     `personas` pe
where f.`id` = df.`factura_id`
and df.`concepto_id`=c.`id`
and c.`tipo_conceptos_id`=tc.id
and f.`id`=l.`comanda_id`
AND STR_TO_DATE(DATE_FORMAT(f.`created_at`, "%d/%m/%Y"),  "%d/%m/%Y") =v_fecha
and l.`equipo_id`=ep.`equipo_id`
and ep.`persona_id`=pe.`id`
and f.estado_id=1
and tc.`id` in (3,1)
group by  pe.`id`, 
STR_TO_DATE(DATE_FORMAT(f.`created_at`, "%d/%m/%Y"),  "%d/%m/%Y");




  INSERT INTO 
  remisions
(
  descripcion,
  persona_id,
  proveedor_id,
  concepto_id,
  tipo_remision_id,
  fecha,
  valor,
  users_id,
  created_at,
  updated_at) 
  
  SELECT 
  "Gasto pago de Lavador" descripcion,
  bp.persona_id,
  1 proveedor_id,
  c.concepto_lavador_gasto concepto_id,
  2 tipo_remision_id,
  bp.fecha,
  bp.valor,
  1 users_id,
  now() created_at,
  now()  updated_at
FROM 
  baseadpersonal bp,
  configuracions c
  where  bp.fecha=v_fecha
  and bp.tipopersonal_id=2 ;

 return "Proceso Ejecutado Correctamente";
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
