<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonasRequest;
use App\Http\Requests\UpdatePersonasRequest;
use App\Repositories\PersonasRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\TipoIdentificacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PersonasController extends AppBaseController
{
    /** @var  PersonasRepository */
    private $personasRepository;

    public function __construct(PersonasRepository $personasRepo)
    {
        $this->personasRepository = $personasRepo;
    }

    /**
     * Display a listing of the Personas.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $personas =  DB::table('personas')
                ->join('tipo_identificacions', 'personas.tipo_identificacion_id', '=', 'tipo_identificacions.id')
                ->selectRaw('personas.*,tipo_identificacions.descripcion as des')
                ->get();

        return view('personas.index')
            ->with('personas', $personas);
    }

    /**
     * Show the form for creating a new Personas.
     *
     * @return Response
     */
    public function create()
    {
        $TipoIdentificacion=TipoIdentificacion::pluck('descripcion','id');
        $datos = ['tipo'=> $TipoIdentificacion];
        return view('personas.create')->with('datos', $datos);
    }

    /**
     * Store a newly created Personas in storage.
     *
     * @param CreatePersonasRequest $request
     *
     * @return Response
     */
    public function store(CreatePersonasRequest $request)
    {
        $input = $request->all();
        $input['users_id']=Auth::id();

        $personas = $this->personasRepository->create($input);

        Flash::success('Personas Guardado exitosamente.');

        return redirect(route('personas.index'));
    }

    /**
     * Display the specified Personas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $personas = $this->personasRepository->findWithoutFail($id);

        if (empty($personas)) {
            Flash::error('Personas not found');

            return redirect(route('personas.index'));
        }

        return view('personas.show')->with('personas', $personas);
    }

    /**
     * Show the form for editing the specified Personas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $personas = $this->personasRepository->findWithoutFail($id);
     
        if (empty($personas)) {
            Flash::error('Personas not found');

            return redirect(route('personas.index'));
        }
        
        $tp=TipoIdentificacion::pluck('descripcion','id');
        $datos = ['personas' => $personas,'tipo'=> $tp];

        return view('personas.edit')->with('datos', $datos);
    }

    /**
     * Update the specified Personas in storage.
     *
     * @param  int              $id
     * @param UpdatePersonasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePersonasRequest $request)
    {
        $personas = $this->personasRepository->findWithoutFail($id);

        if (empty($personas)) {
            Flash::error('Personas not found');

            return redirect(route('personas.index'));
        }

        $personas = $this->personasRepository->update($request->all(), $id);

        Flash::success('Personas Actualizado con exito.');

        return redirect(route('personas.index'));
    }

    /**
     * Remove the specified Personas from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $personas = $this->personasRepository->findWithoutFail($id);

        if (empty($personas)) {
            Flash::error('Personas not found');

            return redirect(route('personas.index'));
        }

        $this->personasRepository->delete($id);

        Flash::success('Personas Borrado con exito.');

        return redirect(route('personas.index'));
    }
}
