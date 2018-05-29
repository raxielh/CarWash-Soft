<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFnCalcularAdministradorLava extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE FUNCTION FnCalculaAdministradorLava(v_fecha DATE) 
                        RETURNS VARCHAR(1000) CHARSET latin1 
                        BEGIN

                          declare s_totalservicios INTEGER(11);
                          declare s_porcenganancia INTEGER(11);
                          declare s_valorganancia INTEGER(11);

                             delete from `baseadpersonal`
                                             where fecha=v_fecha
                                             and tipopersonal_id=1;
                                             
                                             
                                             
                           select round(sum(
                          (df.`cantidad`*df.`valor`)
                          )) as valor_comi
                          into s_totalservicios
                          from factura f,
                               `detallefactura` df,
                               `conceptos` c,
                               `tipo_conceptos` `tc`
                          where f.`id` = df.`factura_id`
                          and df.`concepto_id`=c.`id`
                          and c.`tipo_conceptos_id`=tc.id
                          and f.estado_id=1
                          AND STR_TO_DATE(DATE_FORMAT(f.`created_at`, "%d/%m/%Y"),  "%d/%m/%Y") = v_fecha
                          and tc.`id` in (3,1);
                                             
                               
                          SELECT  ROUND(((max(ga.porcenganancia ))) ) as valor
                          into s_porcenganancia
                          FROM    ganancia_administrivos ga
                            where s_totalservicios between ga.valorini and ga.valorfin;                
                            
                          SELECT  ROUND(((max(s_porcenganancia ))/100) *s_totalservicios) as valor
                          into s_valorganancia;

                           delete from remisions
                          where fecha=v_fecha
                          and concepto_id in 
                          (
                           select c.concepto_admin_gasto
                           from configuracions c
                          );                
                                             

                           

                             INSERT INTO 
                            baseadpersonal
                          (
                            persona_id,
                            fecha,
                            valor,
                            tipopersonal_id,
                            comision,
                            valorventasdia
                            )
                            
                            SELECT 
                            ad.persona_id,
                            v_fecha,
                            s_valorganancia,
                            1,
                            s_porcenganancia,
                            s_totalservicios
                          FROM 
                            administrativos ad 
                            where ad.estado_id=1; 
                            
                            
                            
                            
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
                            "Gasto pago de administrador" descripcion,
                            bp.persona_id,
                            1 proveedor_id,
                            c.concepto_admin_gasto concepto_id,
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
                            and bp.tipopersonal_id=1 ;
                            

                           return "Calculo de Administradores cargado.";
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
