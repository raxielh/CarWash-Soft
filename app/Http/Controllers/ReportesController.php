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
            "SELECT STR_TO_DATE(DATE_FORMAT(f.`created_at`, '%d/%m/%Y'),  '%d/%m/%Y') as fecha, tc.`id` id_tipoconcepto, tc.`descripcion` tipoconcepto ,c.`descripcion` as tipoconcepto,df.`cantidad`,df.`valor`, (df.`cantidad`*df.`valor`) as valortotal
            from factura f,
                 `detallefactura` df,
                 `conceptos` c,
                 `tipo_conceptos` `tc`
            where f.`id` = df.`factura_id`
            and df.`concepto_id`=c.`id`
            and c.`tipo_conceptos_id`=tc.id
            AND STR_TO_DATE(DATE_FORMAT(f.`created_at`, '%d/%m/%Y'),  '%d/%m/%Y') ='".$fecha."'"
        );

        $datos = [
                    'fecha'=> $fecha,
                    'base' => $base,
                    'comda_detalle'=>$comda_detalle,
                ];

        return view('reportes.r1')->with('datos', $datos);
    }   

}
