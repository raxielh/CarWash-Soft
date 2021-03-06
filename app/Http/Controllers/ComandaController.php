<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateComandaRequest;
use App\Http\Requests\UpdateComandaRequest;
use App\Repositories\ComandaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Personas;
use App\Models\Vehiculos;
use App\Models\EstadoComanda;
use App\Models\Comanda;
use App\Models\Equipos;
use App\Models\Conceptos;
use App\Models\Descuento;
use App\Models\ValoresConcepto;
 

class ComandaController extends AppBaseController
{
    /** @var  ComandaRepository */
    private $comandaRepository;

    public function __construct(ComandaRepository $comandaRepo)
    {
        $this->comandaRepository = $comandaRepo;
    }

    /**
     * Display a listing of the Comanda.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->comandaRepository->pushCriteria(new RequestCriteria($request));
        //$comandas = $this->comandaRepository->all();
        /*
        $comandas =  DB::table('comandas')
                ->join('users', 'comandas.users_id', '=', 'users.id')
                ->join('personas', 'comandas.persona_id', '=', 'personas.id')
                ->join('vehiculos', 'comandas.vehiculo_id', '=', 'vehiculos.id')
                ->join('estado_comandas', 'comandas.estado_id', '=', 'estado_comandas.id')
                ->selectRaw('estado_comandas.descripcion as estadodesc,vehiculos.*,comandas.*,users.name,personas.nombre as nom,personas.apellido as ape,personas.identificacion as iden')
                ->orderBy('comandas.id', 'desc')
                ->get();
        */
        $comandas=\App\Models\Comanda::comanda($request->get('campo'),$request->get('estado'))
                        #->toSql();
                        #->get();
                        ->paginate(10);


        return view('comandas.index')
            ->with('comandas', $comandas);
    }

    public function historial(Request $request)
    {
        $this->comandaRepository->pushCriteria(new RequestCriteria($request));
        //$comandas = $this->comandaRepository->all();
        /*
        $comandas =  DB::table('comandas')
                ->join('users', 'comandas.users_id', '=', 'users.id')
                ->join('personas', 'comandas.persona_id', '=', 'personas.id')
                ->join('vehiculos', 'comandas.vehiculo_id', '=', 'vehiculos.id')
                ->join('estado_comandas', 'comandas.estado_id', '=', 'estado_comandas.id')
                ->selectRaw('estado_comandas.descripcion as estadodesc,vehiculos.*,comandas.*,users.name,personas.nombre as nom,personas.apellido as ape,personas.identificacion as iden')
                ->orderBy('comandas.id', 'desc')
                ->get();
        */
        $comandas=\App\Models\Comanda::comanda_h($request->get('campo'),$request->get('estado'),$request->get('fi'),$request->get('ff'))
                        #->toSql();
                        #->get();
                        ->paginate(10);


        return view('comandas.index2')
            ->with('comandas', $comandas);
    }

    /**
     * Show the form for creating a new Comanda.
     *
     * @return Response
     */
    public function create()
    {
        $personas = DB::table('personas')
            ->select(DB::raw('CONCAT(nombre, " ", apellido, " ",identificacion) AS identificacion'), 'id')
            ->pluck('identificacion','id');
        $vehiculos=Vehiculos::pluck('placa','id');
        $estadocomanda=EstadoComanda::pluck('descripcion','id');

        $datos = ['personas' => $personas,'vehiculos'=> $vehiculos,'estadocomanda' =>$estadocomanda];
        return view('comandas.create')->with('datos', $datos);
        //return view('comandas.create');
    }

    /**
     * Store a newly created Comanda in storage.
     *
     * @param CreateComandaRequest $request
     *
     * @return Response
     */
    public function store(CreateComandaRequest $request)
    {
        $input = $request->all();
        $input['users_id']=Auth::id();

        $comanda = $this->comandaRepository->create($input);

        Flash::success('Comanda Guardado exitosamente.');

        $id=$comanda['id'];

        return redirect(route('comandas.show',$id));
    }

    /**
     * Display the specified Comanda.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {

        $comandas =  DB::table('comandas')
                ->join('users', 'comandas.users_id', '=', 'users.id')
                ->join('personas', 'comandas.persona_id', '=', 'personas.id')
                ->join('vehiculos', 'comandas.vehiculo_id', '=', 'vehiculos.id')
                ->join('estado_comandas', 'comandas.estado_id', '=', 'estado_comandas.id')
                ->where('comandas.id',$id)
                ->selectRaw('estado_comandas.descripcion as estadodesc,vehiculos.*,comandas.*,users.name,personas.nombre as nom,personas.apellido as ape,personas.identificacion as iden,estado_comandas.id as estaid')
                ->get();

        $detalles =  DB::table('comanda_detalles')
                ->join('conceptos', 'comanda_detalles.concepto_id', '=', 'conceptos.id')
                ->join('descuentos', 'comanda_detalles.descuentos_id', '=', 'descuentos.id')
                ->where('comanda_detalles.comanda_id',$id)
                ->selectRaw('comanda_detalles.id,conceptos.descripcion,comanda_detalles.descuento,comanda_detalles.valor,comanda_detalles.cantidad,comanda_detalles.impuesto')
                ->get();

        $lavado =  DB::table('lavados')
                ->join('equipos', 'lavados.equipo_id', '=', 'equipos.id')
                ->where('lavados.comanda_id',$id)
                ->selectRaw('equipos.descripcion as equipo')
                ->get();


        $conceptos = DB::table('conceptos')
            ->select(DB::raw('CONCAT(codigo, " ", descripcion) AS descripcion'), 'id')
            ->where('tipo_conceptos_id', '<>' , 4)
            ->pluck('descripcion','id');

        //$conceptos=Conceptos::pluck('descripcion','id');



        $descuento = DB::table('descuentos')
            ->select(DB::raw('CONCAT(codigo, " ", descripcion) AS descripcion'), 'id')
            ->pluck('descripcion','id');
        //$descuento=Descuento::pluck('descripcion','id');

        $datos = [
                    'comandas' => $comandas,
                    'conceptos' => $conceptos,
                    'descuento' => $descuento,
                    'detalles' => $detalles,
                    'lavado' => $lavado,
                ];

        $l_conceptos = DB::table('conceptos')
            ->where('tipo_conceptos_id', '<>' , 4)
            ->get();

        return view('comandas.show')->with('datos', $datos)->with('l_conceptos', $l_conceptos);

    }

    public function show2($id)
    {

        $comandas =  DB::table('comandas')
                ->join('users', 'comandas.users_id', '=', 'users.id')
                ->join('personas', 'comandas.persona_id', '=', 'personas.id')
                ->join('vehiculos', 'comandas.vehiculo_id', '=', 'vehiculos.id')
                ->join('estado_comandas', 'comandas.estado_id', '=', 'estado_comandas.id')
                ->where('comandas.id',$id)
                ->selectRaw('estado_comandas.descripcion as estadodesc,vehiculos.*,comandas.*,users.name,personas.nombre as nom,personas.apellido as ape,personas.identificacion as iden,estado_comandas.id as estaid')
                ->get();

        $detalles =  DB::table('comanda_detalles')
                ->join('conceptos', 'comanda_detalles.concepto_id', '=', 'conceptos.id')
                ->join('descuentos', 'comanda_detalles.descuentos_id', '=', 'descuentos.id')
                ->where('comanda_detalles.comanda_id',$id)
                ->selectRaw('comanda_detalles.id,conceptos.descripcion,descuentos.porcentaje,comanda_detalles.valor')
                ->get();

        $lavado =  DB::table('lavados')
                ->join('equipos', 'lavados.equipo_id', '=', 'equipos.id')
                ->where('lavados.comanda_id',$id)
                ->selectRaw('equipos.descripcion as equipo')
                ->get();


        $conceptos=Conceptos::pluck('descripcion','id');
        $descuento=Descuento::pluck('descripcion','id');

        $datos = [
                    'comandas' => $comandas,
                    'conceptos' => $conceptos,
                    'descuento' => $descuento,
                    'detalles' => $detalles,
                    'lavado' => $lavado,
                ];

        return view('comandas.show2')->with('datos', $datos);

    }
    /**
     * Show the form for editing the specified Comanda.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $comandas = $this->comandaRepository->findWithoutFail($id);

        if (empty($comandas)) {
            Flash::error('Comanda not found');

            return redirect(route('comandas.index'));
        }

        
   
        $personas=Personas::pluck('identificacion','id');
        $vehiculos=Vehiculos::pluck('placa','id');
        $estadocomanda=EstadoComanda::pluck('descripcion','id');

        $datos = [
                    'personas' => $personas,
                    'vehiculos'=> $vehiculos,
                    'estadocomanda' => $estadocomanda,
                    'comandas'=>$comandas
                ];

        return view('comandas.edit')->with('datos', $datos);

    }

    /**
     * Update the specified Comanda in storage.
     *
     * @param  int              $id
     * @param UpdateComandaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateComandaRequest $request)
    {
        $comanda = $this->comandaRepository->findWithoutFail($id);

        if (empty($comanda)) {
            Flash::error('Comanda not found');

            return redirect(route('comandas.index'));
        }

        $comanda = $this->comandaRepository->update($request->all(), $id);

        Flash::success('Comanda Actualizado con exito.');

        return redirect(route('comandas.index'));
    }

    /**
     * Remove the specified Comanda from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $comanda = $this->comandaRepository->findWithoutFail($id);

        if (empty($comanda)) {
            Flash::error('Comanda not found');

            return redirect(route('comandas.index'));
        }

        $this->comandaRepository->delete($id);

        Flash::success('Comanda Borrado con exito.');

        return redirect(route('comandas.index'));
    }

    public function valor_concepto($id)
    {
        $valor_concepto =  DB::table('valores_conceptos')
                ->join('conceptos', 'valores_conceptos.concepto_id', '=', 'conceptos.id')
                ->join('tipo_conceptos', 'conceptos.tipo_conceptos_id', '=', 'tipo_conceptos.id')
                ->where('concepto_id',$id)
                ->selectRaw('valores_conceptos.*,tipo_conceptos.descripcion as des,conceptos.comision,conceptos.impuesto')
                ->orderBy('id', 'desc')
                ->limit(1)
                ->get();
        //$valor_concepto = ValoresConcepto::find($id);
        return $valor_concepto;   
    }

    public function valor_concepto_descuento($id)
    {
        $descuento = Descuento::find($id);
        return $descuento;   
    }

    public function facturar($id)
    {
        $comanda = $id;
        $consultar_factura =  DB::table('factura')
                ->where('id',$id)
                ->get();

        if(count($consultar_factura)==0){
            DB::select('CALL ProFacturarComanda(?)',array($id));
            $factura =  DB::table('factura')
                ->join('users', 'factura.users_id', '=', 'users.id')
                ->join('personas', 'factura.persona_id', '=', 'personas.id')
                ->join('vehiculos', 'factura.vehiculo_id', '=', 'vehiculos.id')
                ->join('estado_comandas', 'factura.estado_id', '=', 'estado_comandas.id')
                ->where('factura.id',$id)
                ->selectRaw('estado_comandas.descripcion as estadodesc,vehiculos.*,factura.*,users.name,personas.nombre as nom,personas.apellido as ape,personas.identificacion as iden,estado_comandas.id as estaid,personas.telefono1,personas.direccion,factura.id as numero,'.
                    DB::raw('DATE_FORMAT(factura.created_at, "%Y-%m-%d")').' as fecha '

                )
                ->selectRaw(DB::raw('DATE_FORMAT(factura.created_at, "%H:%i:%s")').' as hora ')
                ->get();

            $detalles =  DB::table('detallefactura')
                ->join('conceptos', 'detallefactura.concepto_id', '=', 'conceptos.id')
                ->join('descuentos', 'detallefactura.descuentos_id', '=', 'descuentos.id')
                ->where('detallefactura.factura_id',$id)
                ->selectRaw('detallefactura.id,conceptos.descripcion,detallefactura.descuento,detallefactura.valor,detallefactura.cantidad,detallefactura.impuesto')
                ->get();

            $datos = ['factura' => $factura,'detalles'=> $detalles];
            return view('factura.index')
                ->with('datos', $datos);
        }else{

            $factura =  DB::table('factura')
                ->join('users', 'factura.users_id', '=', 'users.id')
                ->join('personas', 'factura.persona_id', '=', 'personas.id')
                ->join('vehiculos', 'factura.vehiculo_id', '=', 'vehiculos.id')
                ->join('estado_comandas', 'factura.estado_id', '=', 'estado_comandas.id')
                ->where('factura.id',$id)
                ->selectRaw('estado_comandas.descripcion as estadodesc,vehiculos.*,factura.*,users.name,personas.nombre as nom,personas.apellido as ape,personas.identificacion as iden,estado_comandas.id as estaid,personas.telefono1,personas.direccion,factura.id as numero,'.
                    DB::raw('DATE_FORMAT(factura.created_at, "%Y-%m-%d")').' as fecha '

                )
                ->selectRaw(DB::raw('DATE_FORMAT(factura.created_at, "%H:%i:%s")').' as hora ')
                ->get();

            $detalles =  DB::table('detallefactura')
                ->join('conceptos', 'detallefactura.concepto_id', '=', 'conceptos.id')
                ->join('descuentos', 'detallefactura.descuentos_id', '=', 'descuentos.id')
                ->where('detallefactura.factura_id',$id)
                ->selectRaw('detallefactura.id,conceptos.descripcion,detallefactura.descuento,detallefactura.valor,detallefactura.cantidad,detallefactura.impuesto')
                ->get();

            $datos = ['factura' => $factura,'detalles'=> $detalles];

            return view('factura.index')
                ->with('datos', $datos);

        }



        //DB::select('CALL ProFacturarComanda(?)',array($id));
        
    }

    public function buscar_propietario($id)
    {
        $propietario =  DB::table('vehiculos')
                ->where('id',$id)
                ->get();
        return $propietario;   
    }

    public function buscar_concepto($id)
    {
        //return $id;
        $descuento = DB::table('descuentos')->pluck('descripcion','id');
        
        $l_conceptos = DB::select('
                                            SELECT 
                                              c.`id`,
                                              c.`codigo`,
                                              c.`descripcion`,
                                              c.`impuesto`,
                                              c.`comision`,
                                              c.`impuesto`,
                                              c.`estado_id`,
                                              c.`imagen`,
                                              v.`valor`
                                            FROM
                                              conceptos c,
                                              valores_conceptos v
                                            WHERE
                                              c.id=v.concepto_id
                                              AND `tipo_conceptos_id` <> 4 
                                              AND `tipo_conceptos_id` <> 2
                                              AND c.`estado_id`=1
                                              AND  v.created_at IN
                                                (SELECT MAX(v2.created_at) 
                                                    FROM valores_conceptos v2
                                                    WHERE c.id=v2.concepto_id)
                                            ORDER BY c.`codigo`
                                        ');

        return view('comandas.busca')->with('l_conceptos', $l_conceptos)->with('id', $id)->with('descuento', $descuento);
    }

    public function calcular_subtotal($id)
    {
        $sub = DB::select('
                                    SELECT 
                                    SUM(valor*cantidad-((valor*cantidad)*(descuento/100))) AS sub
                                    FROM
                                      comanda_detalles
                                    WHERE
                                      comanda_id='.$id);
         $response = array(
          'sub' => $sub
        );

        return response()->json($sub); 
    }

}
