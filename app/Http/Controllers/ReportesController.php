<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVehiculosRequest;
use App\Http\Requests\UpdateVehiculosRequest;
use App\Repositories\VehiculosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Personas;
use App\Models\Vehiculos;
use App\Models\Marca;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReportesController extends AppBaseController
{

    /**
     * Display a listing of the Vehiculos.
     *
     * @param Request $request
     * @return Response
     */

    public function v_ingresosyegresos()
    {
        return view('reportes.index');
    }   

      public function v_admin_lavadores()
    {
        return view('reportes2.index');
    } 

    public function ingresosyegresos(Request $request)
    {
        $fecha=$request->fecha;
        $msg='Reporte Generado...';

        $base = DB::table('basegancia')->where('fecha',$fecha)->get();
        
        $comda_detalle = DB::select(
            " 
SELECT STR_TO_DATE(DATE_FORMAT(f.`created_at`, '%d/%m/%Y'),  '%d/%m/%Y') as fecha, 
tc.`id` id_tipoconcepto, 
tc.`descripcion` tipoconcepto ,
c.`descripcion` as tipoconcepto,
df.`valor`,
sum(df.`cantidad`) as cantidad ,
sum(df.`cantidad`*df.`valor`) as valortotal
            from factura f,
                 `detallefactura` df,
                 `conceptos` c,
                 `tipo_conceptos` `tc`
            where f.`id` = df.`factura_id`
            and df.`concepto_id`=c.`id`
            and c.`tipo_conceptos_id`=tc.id
            and tc.`id` in (3,1)
            AND STR_TO_DATE(DATE_FORMAT(f.`created_at`, '%d/%m/%Y'),  '%d/%m/%Y') ='".$fecha."'
            group by STR_TO_DATE(DATE_FORMAT(f.`created_at`, '%d/%m/%Y'),  '%d/%m/%Y') ,
                     tc.`id` , 
                    tc.`descripcion`  ,
                    c.`descripcion`,
                    df.`valor` "
        );

        $total_patio=  DB::select(
            " 
   SELECT count(f.`id`), 
sum(df.`cantidad`*df.`valor`) as totalpatio
            from factura f,
                 `detallefactura` df,
                 `conceptos` c,
                 `tipo_conceptos` `tc`
            where f.`id` = df.`factura_id`
            and df.`concepto_id`=c.`id`
            and c.`tipo_conceptos_id`=tc.id
            and tc.`id` in (3,1)
            and f.`estado_id`=1
            AND STR_TO_DATE(DATE_FORMAT(f.`created_at`, '%d/%m/%Y'),  '%d/%m/%Y') ='".$fecha."'

            ");

               $numero_carros=  DB::select(
            " 
  SELECT count(*) numerocarros
            from factura f
            where  f.`estado_id`=1
            AND STR_TO_DATE(DATE_FORMAT(f.`created_at`, '%d/%m/%Y'),  '%d/%m/%Y')  ='".$fecha."'

            ");


                 $comda_detalle_cafetaria = DB::select(
            " 
SELECT STR_TO_DATE(DATE_FORMAT(f.`created_at`, '%d/%m/%Y'),  '%d/%m/%Y') as fecha, 
tc.`id` id_tipoconcepto, 
tc.`descripcion` tipoconcepto ,
c.`descripcion` as tipoconcepto,
df.`valor`,
sum(df.`cantidad`) as cantidad ,
sum(df.`cantidad`*df.`valor`) as valortotal
            from factura f,
                 `detallefactura` df,
                 `conceptos` c,
                 `tipo_conceptos` `tc`
            where f.`id` = df.`factura_id`
            and df.`concepto_id`=c.`id`
            and c.`tipo_conceptos_id`=tc.id
            and tc.`id` in (2)
            AND STR_TO_DATE(DATE_FORMAT(f.`created_at`, '%d/%m/%Y'),  '%d/%m/%Y') ='".$fecha."'
            group by STR_TO_DATE(DATE_FORMAT(f.`created_at`, '%d/%m/%Y'),  '%d/%m/%Y') ,
                     tc.`id` , 
                    tc.`descripcion`  ,
                    c.`descripcion`,
                    df.`valor` "
        );

 $total_cafetaria=  DB::select(
            " 
   SELECT count(f.`id`), 
sum(df.`cantidad`*df.`valor`) as totalpatio
            from factura f,
                 `detallefactura` df,
                 `conceptos` c,
                 `tipo_conceptos` `tc`
            where f.`id` = df.`factura_id`
            and df.`concepto_id`=c.`id`
            and c.`tipo_conceptos_id`=tc.id
            and tc.`id` in (2)
            and f.`estado_id`=1
            AND STR_TO_DATE(DATE_FORMAT(f.`created_at`, '%d/%m/%Y'),  '%d/%m/%Y') ='".$fecha."'

            ");

  $salidas=  DB::select(
            " 
  SELECT  c.`descripcion` descconcepto, count(*) cantidad,  sum(r.valor)  as valor
FROM   remisions  r,
       `conceptos` c
where  r.fecha='".$fecha."'
and r.tipo_remision_id=2
and r.`concepto_id`=c.`id`
group by c.`descripcion`;

            ");

   $entradas=  DB::select(
            " 
  SELECT  c.`descripcion` descconcepto, count(*) cantidad,  sum(r.valor)  as valor
FROM   remisions  r,
       `conceptos` c
where  r.fecha='".$fecha."'
and r.tipo_remision_id=1 
and r.`concepto_id`=c.`id`
group by c.`descripcion`;

            ");

        $datos = [
                    'fecha'=> $fecha,
                    'base' => $base,
                    'comda_detalle'=>$comda_detalle,
                    'total_patio'=>$total_patio,
                    'numero_carros'=>$numero_carros,
                    'comda_detalle_cafetaria'=>$comda_detalle_cafetaria,
                    'total_cafetaria'=>$total_cafetaria,
                    'entradas'=>$entradas,
                    'salidas'=>$salidas,                    
                ];

        return view('reportes.r1')->with('datos', $datos);
    }   



    public function adminlavadores(Request $request)
    {
        $fecha=$request->fecha;
        $msg='Reporte Generado...';

        $base = DB::table('basegancia')->where('fecha',$fecha)->get();
        
        $adminlava = DB::select(
            " 

               select  cast(if(gh.orden=1,@rownum:=@rownum+1 ,@rownum:=0 ) as char(10)) secu,
                gh.orden,
                gh.id, 
                gh.fecha,
                gh.apellido,
                gh.nombre,
                gh.descripcion,
                gh.comision,
                gh.cantidad,
                gh.valor,
                gh.valor_comi,
                gh.tipoper
                from 
                (
                  select 1 as orden,
                  pe.id, 
                STR_TO_DATE(DATE_FORMAT(f.created_at, '%d/%m/%Y'),  '%d/%m/%Y') as fecha,
                pe.apellido,
                pe.nombre,
                c.descripcion,
                c.comision,
                df.cantidad,
                df.valor,
                sum(
                (df.cantidad*df.valor)*(c.comision/100)
                ) as valor_comi,2 as tipoper
                from factura f,
                     detallefactura df,
                     conceptos c,
                     tipo_conceptos tc,
                     lavados l,
                     equipo_personas ep,
                     personas pe
                where f.id = df.factura_id
                and df.concepto_id=c.id
                and c.tipo_conceptos_id=tc.id
                and f.id=l.comanda_id
                AND STR_TO_DATE(DATE_FORMAT(f.created_at, '%d/%m/%Y'),  '%d/%m/%Y') ='".$fecha."'
                and l.equipo_id=ep.equipo_id
                and ep.persona_id=pe.id
                and f.estado_id=1
                and tc.id in (3,1)
                group by  pe.id, STR_TO_DATE(DATE_FORMAT(f.created_at, '%d/%m/%Y'),  '%d/%m/%Y'),
                pe.apellido,
                pe.nombre,
                c.descripcion,
                c.comision,
                df.cantidad,
                df.valor

                union all

                SELECT 
                  2 as orden,
                  bp.persona_id, 
                 bp.fecha,
                  pe.apellido,
                  pe.nombre,
                CONCAT('Total :',pe.apellido, ' ', pe.nombre)   as descripcion,
                null as comision,
                 null as cantidad,
                  null as valor,
                 bp.valor as valor_comi,
                 bp.`tipopersonal_id`
                FROM 
                  baseadpersonal bp,
                   personas pe
                where  bp.fecha='".$fecha."'
                and   bp.persona_id=pe.id
                and  bp.`tipopersonal_id`=2
                ) as gh,(SELECT @rownum:=0) r
                order by gh.apellido,
                gh.nombre,
                gh.orden   
"
        );

       

        $datos = [
                    'fecha'=> $fecha,
                    'base' => $base,
                    'adminlava' => $adminlava,          
                ];

        return view('reportes2.r1')->with('datos', $datos);
    } 
}
