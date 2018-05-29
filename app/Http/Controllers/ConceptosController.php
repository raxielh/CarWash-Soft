<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateConceptosRequest;
use App\Http\Requests\UpdateConceptosRequest;
use App\Repositories\ConceptosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\tipoConceptos;
use App\Models\Estados;
use App\Models\Conceptos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ConceptosController extends AppBaseController
{
    /** @var  ConceptosRepository */
    private $conceptosRepository;

    public function __construct(ConceptosRepository $conceptosRepo)
    {
        $this->conceptosRepository = $conceptosRepo;
    }

    /**
     * Display a listing of the Conceptos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $conceptos =  DB::table('conceptos')
                ->join('users', 'conceptos.users_id', '=', 'users.id')
                ->join('estados', 'conceptos.estado_id', '=', 'estados.id')
                ->join('tipo_conceptos', 'conceptos.tipo_conceptos_id', '=', 'tipo_conceptos.id')
                ->selectRaw('conceptos.*,users.name,estados.descripcion as desc_estado,tipo_conceptos.descripcion as desctp')
                ->get();

        return view('conceptos.index')
            ->with('conceptos', $conceptos);
    }

    /**
     * Show the form for creating a new Conceptos.
     *
     * @return Response
     */
    public function create()
    {
        $tipo_conceptos=tipoConceptos::pluck('descripcion','id');
        $estados=Estados::pluck('descripcion','id');
        $datos = ['tipos' => $tipo_conceptos, 'estados' => $estados];
        return view('conceptos.create')->with('datos', $datos);
    }

    /**
     * Store a newly created Conceptos in storage.
     *
     * @param CreateConceptosRequest $request
     *
     * @return Response
     */
    public function store(CreateConceptosRequest $request)
    {
        //return $request->file('imagen');
        $input = $request->all();
        $input['users_id']=Auth::id();
        $input['imagen']=$request->file('imagen')->store('public');

        //return $input;
        $conceptos = $this->conceptosRepository->create($input);

        Flash::success('Conceptos Guardado exitosamente.');

        return redirect(route('conceptos.index'));
    }

    /**
     * Display the specified Conceptos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /*
        $conceptos = $this->conceptosRepository->findWithoutFail($id);

        if (empty($conceptos)) {
            Flash::error('Conceptos not found');

            return redirect(route('conceptos.index'));
        }
        */
        $conceptos =  DB::table('conceptos')
                ->join('users', 'conceptos.users_id', '=', 'users.id')
                ->join('estados', 'conceptos.estado_id', '=', 'estados.id')
                ->join('tipo_conceptos', 'conceptos.tipo_conceptos_id', '=', 'tipo_conceptos.id')
                ->where('conceptos.id',$id)
                ->selectRaw('conceptos.*,users.name,estados.descripcion as desc_estado,tipo_conceptos.descripcion as desctp,tipo_conceptos.id as idtipo')
                ->get();

        $sql = "SELECT 
                    combos.*,
                    users.name,
                    estados.descripcion AS descestado,
                    conceptos1.descripcion AS combo,
                    conceptos2.descripcion AS producto,
                    conceptos2.comision,
                    conceptos2.impuesto
                    FROM 
                    combos,
                    conceptos AS conceptos1,
                    conceptos AS conceptos2,
                    users,
                    estados
                    WHERE
                    combos.users_id=users.id AND
                    combos.estado_id=estados.id AND
                    combos.concepto_id1=conceptos1.id AND
                    combos.concepto_id2=conceptos2.id AND
                     combos.concepto_id1=".$id;
        $combos = DB::select($sql);

        $productos=Conceptos::where('tipo_conceptos_id', '<>' , 1)->pluck('descripcion','id');
        $estados=Estados::pluck('descripcion','id');

        $precios =  DB::table('valores_conceptos')
                ->where('valores_conceptos.concepto_id',$id)
                ->selectRaw('valores_conceptos.*')
                ->orderByRaw('created_at DESC')
                ->get();



        $datos = [
                    'conceptos' => $conceptos,
                    'productos' => $productos,
                    'estados' => $estados,
                    'combos' => $combos,
                    'precios' => $precios,
                ];

        return view('conceptos.show')->with('datos', $datos);
    }

    /**
     * Show the form for editing the specified Conceptos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $conceptos = $this->conceptosRepository->findWithoutFail($id);

        if (empty($conceptos)) {
            Flash::error('Conceptos not found');

            return redirect(route('conceptos.index'));
        }

        $tipo_conceptos=tipoConceptos::pluck('descripcion','id');

        $estados=Estados::pluck('descripcion','id');
        $datos = ['tipos' => $tipo_conceptos, 'estados' => $estados,'conceptos'=> $conceptos];
        return view('conceptos.edit')->with('datos', $datos);
    }

    /**
     * Update the specified Conceptos in storage.
     *
     * @param  int              $id
     * @param UpdateConceptosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConceptosRequest $request)
    {
        //dd($request->all());
         $conceptos = $this->conceptosRepository->findWithoutFail($id);
 
        if (empty($conceptos)) {
            Flash::error('Conceptos not found');

            return redirect(route('conceptos.index'));
        }

                $request = array(
                            "_method" => $request->_method,
                            "_token"  => $request->_token,
                            "codigo" => $request->codigo,
                            "descripcion" => $request->descripcion,
                            "tipo_conceptos_id" =>$request->tipo_conceptos_id,
                            "estado_id" =>$request->estado_id,
                            "comision" =>$request->comision,
                            "impuesto" =>$request->impuesto,
                            "imagen"    => $request->file('imagen')->store('public')
                        );

        $conceptos = $this->conceptosRepository->update($request, $id);

        //dd($conceptos);

        Flash::success('Conceptos Actualizado con exito.');

        return redirect(route('conceptos.index'));
    }

    /**
     * Remove the specified Conceptos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $conceptos = $this->conceptosRepository->findWithoutFail($id);

        if (empty($conceptos)) {
            Flash::error('Conceptos not found');

            return redirect(route('conceptos.index'));
        }

        $this->conceptosRepository->delete($id);

        Flash::success('Conceptos Borrado con exito.');

        return redirect(route('conceptos.index'));
    }
}
