<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEquiposRequest;
use App\Http\Requests\UpdateEquiposRequest;
use App\Repositories\EquiposRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EquiposController extends AppBaseController
{
    /** @var  EquiposRepository */
    private $equiposRepository;

    public function __construct(EquiposRepository $equiposRepo)
    {
        $this->equiposRepository = $equiposRepo;
    }

    /**
     * Display a listing of the Equipos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $equipos =  DB::table('equipos')
                ->join('users', 'equipos.users_id', '=', 'users.id')
                ->selectRaw('equipos.*,users.name')
                ->get();

        return view('equipos.index')
            ->with('equipos', $equipos);
    }

    /**
     * Show the form for creating a new Equipos.
     *
     * @return Response
     */
    public function create()
    {
        return view('equipos.create');
    }

    /**
     * Store a newly created Equipos in storage.
     *
     * @param CreateEquiposRequest $request
     *
     * @return Response
     */
    public function store(CreateEquiposRequest $request)
    {
        $input = $request->all();
        $input['users_id']=Auth::id();

        $equipos = $this->equiposRepository->create($input);

        Flash::success('Equipos Guardado exitosamente.');

        return redirect(route('equipos.index'));
    }

    /**
     * Display the specified Equipos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $equipos = $this->equiposRepository->findWithoutFail($id);

        if (empty($equipos)) {
            Flash::error('Equipos not found');

            return redirect(route('equipos.index'));
        }

        return view('equipos.show')->with('equipos', $equipos);
    }

    /**
     * Show the form for editing the specified Equipos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $equipos = $this->equiposRepository->findWithoutFail($id);

        if (empty($equipos)) {
            Flash::error('Equipos not found');

            return redirect(route('equipos.index'));
        }

        return view('equipos.edit')->with('equipos', $equipos);
    }

    /**
     * Update the specified Equipos in storage.
     *
     * @param  int              $id
     * @param UpdateEquiposRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEquiposRequest $request)
    {
        $equipos = $this->equiposRepository->findWithoutFail($id);

        if (empty($equipos)) {
            Flash::error('Equipos not found');

            return redirect(route('equipos.index'));
        }

        $equipos = $this->equiposRepository->update($request->all(), $id);

        Flash::success('Equipos Actualizado con exito.');

        return redirect(route('equipos.index'));
    }

    /**
     * Remove the specified Equipos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $equipos = $this->equiposRepository->findWithoutFail($id);

        if (empty($equipos)) {
            Flash::error('Equipos not found');

            return redirect(route('equipos.index'));
        }

        $this->equiposRepository->delete($id);

        Flash::success('Equipos Borrado con exito.');

        return redirect(route('equipos.index'));
    }
}
