<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEquipoPersonasRequest;
use App\Http\Requests\UpdateEquipoPersonasRequest;
use App\Repositories\EquipoPersonasRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Estados;

class EquipoPersonasController extends AppBaseController
{
    /** @var  EquipoPersonasRepository */
    private $equipoPersonasRepository;

    public function __construct(EquipoPersonasRepository $equipoPersonasRepo)
    {
        $this->equipoPersonasRepository = $equipoPersonasRepo;
    }

    /**
     * Display a listing of the EquipoPersonas.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->equipoPersonasRepository->pushCriteria(new RequestCriteria($request));
        $equipoPersonas = $this->equipoPersonasRepository->all();

        return view('equipo_personas.index')
            ->with('equipoPersonas', $equipoPersonas);
    }

    /**
     * Show the form for creating a new EquipoPersonas.
     *
     * @return Response
     */
    public function create()
    {
        return view('equipo_personas.create');
    }

    /**
     * Store a newly created EquipoPersonas in storage.
     *
     * @param CreateEquipoPersonasRequest $request
     *
     * @return Response
     */
    public function store(CreateEquipoPersonasRequest $request)
    {
        $input = $request->all();
        $input['users_id']=Auth::id();
        $equipoPersonas = $this->equipoPersonasRepository->create($input);

        Flash::success('Equipo Personas Guardado exitosamente.');

        //return redirect(route('equipoPersonas.index'));
        return back();
    }

    /**
     * Display the specified EquipoPersonas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $equipoPersonas = $this->equipoPersonasRepository->findWithoutFail($id);

        if (empty($equipoPersonas)) {
            Flash::error('Equipo Personas not found');

            return redirect(route('equipoPersonas.index'));
        }

        return view('equipo_personas.show')->with('equipoPersonas', $equipoPersonas);
    }

    /**
     * Show the form for editing the specified EquipoPersonas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $equipoPersonas = $this->equipoPersonasRepository->findWithoutFail($id);

        if (empty($equipoPersonas)) {
            Flash::error('Equipo Personas not found');

            return redirect(route('equipoPersonas.index'));
        }

        $estados=Estados::pluck('descripcion','id');

        $datos = [
                    'estados' => $estados,
                    'equipoPersonas' => $equipoPersonas
                ];


        return view('equipo_personas.edit')->with('datos', $datos);
    }

    /**
     * Update the specified EquipoPersonas in storage.
     *
     * @param  int              $id
     * @param UpdateEquipoPersonasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEquipoPersonasRequest $request)
    {
        $equipoPersonas = $this->equipoPersonasRepository->findWithoutFail($id);

        if (empty($equipoPersonas)) {
            Flash::error('Equipo Personas not found');

            return redirect(route('equipoPersonas.index'));
        }

        $equipoPersonas = $this->equipoPersonasRepository->update($request->all(), $id);

        Flash::success('Equipo Personas Actualizado con exito.');

        //return redirect(route('equipoPersonas.index'));
        return back();
    }

    /**
     * Remove the specified EquipoPersonas from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $equipoPersonas = $this->equipoPersonasRepository->findWithoutFail($id);

        if (empty($equipoPersonas)) {
            Flash::error('Equipo Personas not found');

            return redirect(route('equipoPersonas.index'));
        }

        $this->equipoPersonasRepository->delete($id);

        Flash::success('Equipo Personas Borrado con exito.');

        //return redirect(route('equipoPersonas.index'));
        return back();
    }
}
