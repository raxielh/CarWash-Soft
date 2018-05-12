<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRemisionRequest;
use App\Http\Requests\UpdateRemisionRequest;
use App\Repositories\RemisionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Estados;
use App\Models\Proveedores;
use App\Models\Conceptos;

class RemisionController extends AppBaseController
{
    /** @var  RemisionRepository */
    private $remisionRepository;

    public function __construct(RemisionRepository $remisionRepo)
    {
        $this->remisionRepository = $remisionRepo;
    }

    /**
     * Display a listing of the Remision.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
       /* $this->remisionRepository->pushCriteria(new RequestCriteria($request));
        $remisions = $this->remisionRepository->all();*/

        $remisions =  DB::table('remisions')
                ->join('users', 'remisions.users_id', '=', 'users.id')
                ->join('personas', 'remisions.persona_id', '=', 'personas.id')
                ->join('proveedores', 'remisions.proveedor_id', '=', 'proveedores.id')
                ->join('conceptos', 'remisions.concepto_id', '=', 'conceptos.id')
                ->join('tipo_remision', 'remisions.tipo_remision_id', '=', 'tipo_remision.id')
                ->selectRaw('remisions.*,users.name,personas.nombre,personas.apellido,personas.identificacion,proveedores.razon_social,conceptos.descripcion as con,tipo_remision.descripcion as tr')
                ->get();

        return view('remisions.index')
            ->with('remisions', $remisions);
    }

    /**
     * Show the form for creating a new Remision.
     *
     * @return Response
     */
    public function create()
    {
        $personas = DB::table('personas')
            ->select(DB::raw('CONCAT(nombre, " ", apellido, " ",identificacion) AS identificacion'), 'id')
            ->pluck('identificacion','id');
        
        $proveedores=Proveedores::pluck('razon_social','id');

        $Conceptos = DB::table('conceptos')
            ->where('tipo_conceptos_id', '4')
            ->pluck('descripcion','id');

        $tipo_r = DB::table('tipo_remision')
            ->pluck('descripcion','id');

        $datos = ['personas' => $personas,'proveedores' => $proveedores,'Conceptos' => $Conceptos,'tipo_r' => $tipo_r];
        return view('remisions.create')->with('datos', $datos);
    }

    /**
     * Store a newly created Remision in storage.
     *
     * @param CreateRemisionRequest $request
     *
     * @return Response
     */
    public function store(CreateRemisionRequest $request)
    {
        $input = $request->all();
        $input['users_id']=Auth::id();

        $remision = $this->remisionRepository->create($input);

        Flash::success('Remision Guardado exitosamente.');

        return redirect(route('remisions.index'));
    }

    /**
     * Display the specified Remision.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $remision = $this->remisionRepository->findWithoutFail($id);

        if (empty($remision)) {
            Flash::error('Remision not found');

            return redirect(route('remisions.index'));
        }

        return view('remisions.show')->with('remision', $remision);
    }

    /**
     * Show the form for editing the specified Remision.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $remision = $this->remisionRepository->findWithoutFail($id);

        if (empty($remision)) {
            Flash::error('Remision not found');

            return redirect(route('remisions.index'));
        }

        $personas = DB::table('personas')
            ->select(DB::raw('CONCAT(nombre, " ", apellido, " ",identificacion) AS identificacion'), 'id')
            ->pluck('identificacion','id');
        
        $proveedores=Proveedores::pluck('razon_social','id');

        $Conceptos = DB::table('conceptos')
            ->where('tipo_conceptos_id', '4')
            ->pluck('descripcion','id');

        $tipo_r = DB::table('tipo_remision')
            ->pluck('descripcion','id');

        $datos = ['personas' => $personas,'proveedores' => $proveedores,'Conceptos' => $Conceptos,'tipo_r' => $tipo_r,'remision'=>$remision ];


        return view('remisions.edit')->with('datos', $datos);
    }

    /**
     * Update the specified Remision in storage.
     *
     * @param  int              $id
     * @param UpdateRemisionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRemisionRequest $request)
    {
        $remision = $this->remisionRepository->findWithoutFail($id);

        if (empty($remision)) {
            Flash::error('Remision not found');

            return redirect(route('remisions.index'));
        }

        $remision = $this->remisionRepository->update($request->all(), $id);

        Flash::success('Remision Actualizado con exito.');

        return redirect(route('remisions.index'));
    }

    /**
     * Remove the specified Remision from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $remision = $this->remisionRepository->findWithoutFail($id);

        if (empty($remision)) {
            Flash::error('Remision not found');

            return redirect(route('remisions.index'));
        }

        $this->remisionRepository->delete($id);

        Flash::success('Remision Borrado con exito.');

        return redirect(route('remisions.index'));
    }
}
