<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdministrativoRequest;
use App\Http\Requests\UpdateAdministrativoRequest;
use App\Repositories\AdministrativoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdministrativoController extends AppBaseController
{
    /** @var  AdministrativoRepository */
    private $administrativoRepository;

    public function __construct(AdministrativoRepository $administrativoRepo)
    {
        $this->administrativoRepository = $administrativoRepo;
    }

    /**
     * Display a listing of the Administrativo.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->administrativoRepository->pushCriteria(new RequestCriteria($request));
        $administrativos = $this->administrativoRepository->all();
        $administrativos =  DB::table('administrativos')
                ->join('users', 'administrativos.users_id', '=', 'users.id')
                ->join('personas', 'administrativos.persona_id', '=', 'personas.id')
                ->join('estados', 'administrativos.estado_id', '=', 'estados.id')
                ->selectRaw('administrativos.*,users.name,personas.nombre as nom,personas.apellido as ape,personas.identificacion as iden,estados.descripcion as esta')
                ->get();


        return view('administrativos.index')
            ->with('administrativos', $administrativos);
    }

    /**
     * Show the form for creating a new Administrativo.
     *
     * @return Response
     */
    public function create()
    {
        $personas = DB::table('personas')
            ->select(DB::raw('CONCAT(nombre, " ", apellido," ",identificacion) AS des'), 'id')
            ->pluck('des','id');
        $estados = DB::table('estados')
            ->pluck('descripcion','id');
        //$personas=Personas::pluck('des','id');
        $datos = ['personas' => $personas,'estados' => $estados];
        return view('administrativos.create')->with('datos', $datos);
    }

    /**
     * Store a newly created Administrativo in storage.
     *
     * @param CreateAdministrativoRequest $request
     *
     * @return Response
     */
    public function store(CreateAdministrativoRequest $request)
    {
        $input = $request->all();
        $input['users_id']=Auth::id();

        $administrativo = $this->administrativoRepository->create($input);

        Flash::success('Administrativo Guardado exitosamente.');

        return redirect(route('administrativos.index'));
    }

    /**
     * Display the specified Administrativo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $administrativo = $this->administrativoRepository->findWithoutFail($id);

        if (empty($administrativo)) {
            Flash::error('Administrativo not found');

            return redirect(route('administrativos.index'));
        }

        return view('administrativos.show')->with('administrativo', $administrativo);
    }

    /**
     * Show the form for editing the specified Administrativo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $administrativo = $this->administrativoRepository->findWithoutFail($id);

        if (empty($administrativo)) {
            Flash::error('Administrativo not found');

            return redirect(route('administrativos.index'));
        }
        $personas = DB::table('personas')
            ->select(DB::raw('CONCAT(nombre, " ", apellido," ",identificacion) AS des'), 'id')
            ->pluck('des','id');
        $estados = DB::table('estados')
            ->pluck('descripcion','id');
        //$personas=Personas::pluck('des','id');
        $datos = ['personas' => $personas,'estados' => $estados,'administrativo' => $administrativo];
        return view('administrativos.edit')->with('datos', $datos);
    }

    /**
     * Update the specified Administrativo in storage.
     *
     * @param  int              $id
     * @param UpdateAdministrativoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdministrativoRequest $request)
    {
        $administrativo = $this->administrativoRepository->findWithoutFail($id);

        if (empty($administrativo)) {
            Flash::error('Administrativo not found');

            return redirect(route('administrativos.index'));
        }

        $administrativo = $this->administrativoRepository->update($request->all(), $id);

        Flash::success('Administrativo Actualizado con exito.');

        return redirect(route('administrativos.index'));
    }

    /**
     * Remove the specified Administrativo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $administrativo = $this->administrativoRepository->findWithoutFail($id);

        if (empty($administrativo)) {
            Flash::error('Administrativo not found');

            return redirect(route('administrativos.index'));
        }

        $this->administrativoRepository->delete($id);

        Flash::success('Administrativo Borrado con exito.');

        return redirect(route('administrativos.index'));
    }
}
