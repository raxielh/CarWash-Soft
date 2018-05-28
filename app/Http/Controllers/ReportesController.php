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

}
