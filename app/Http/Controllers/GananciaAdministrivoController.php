<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGananciaAdministrivoRequest;
use App\Http\Requests\UpdateGananciaAdministrivoRequest;
use App\Repositories\GananciaAdministrivoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class GananciaAdministrivoController extends AppBaseController
{
    /** @var  GananciaAdministrivoRepository */
    private $gananciaAdministrivoRepository;

    public function __construct(GananciaAdministrivoRepository $gananciaAdministrivoRepo)
    {
        $this->gananciaAdministrivoRepository = $gananciaAdministrivoRepo;
    }

    /**
     * Display a listing of the GananciaAdministrivo.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->gananciaAdministrivoRepository->pushCriteria(new RequestCriteria($request));
        $gananciaAdministrivos = $this->gananciaAdministrivoRepository->all();

        return view('ganancia_administrivos.index')
            ->with('gananciaAdministrivos', $gananciaAdministrivos);
    }

    /**
     * Show the form for creating a new GananciaAdministrivo.
     *
     * @return Response
     */
    public function create()
    {
        return view('ganancia_administrivos.create');
    }

    /**
     * Store a newly created GananciaAdministrivo in storage.
     *
     * @param CreateGananciaAdministrivoRequest $request
     *
     * @return Response
     */
    public function store(CreateGananciaAdministrivoRequest $request)
    {
        $input = $request->all();

        $gananciaAdministrivo = $this->gananciaAdministrivoRepository->create($input);

        Flash::success('Ganancia Administrivo Guardado exitosamente.');

        return redirect(route('gananciaAdministrivos.index'));
    }

    /**
     * Display the specified GananciaAdministrivo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $gananciaAdministrivo = $this->gananciaAdministrivoRepository->findWithoutFail($id);

        if (empty($gananciaAdministrivo)) {
            Flash::error('Ganancia Administrivo not found');

            return redirect(route('gananciaAdministrivos.index'));
        }

        return view('ganancia_administrivos.show')->with('gananciaAdministrivo', $gananciaAdministrivo);
    }

    /**
     * Show the form for editing the specified GananciaAdministrivo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $gananciaAdministrivo = $this->gananciaAdministrivoRepository->findWithoutFail($id);

        if (empty($gananciaAdministrivo)) {
            Flash::error('Ganancia Administrivo not found');

            return redirect(route('gananciaAdministrivos.index'));
        }

        return view('ganancia_administrivos.edit')->with('gananciaAdministrivo', $gananciaAdministrivo);
    }

    /**
     * Update the specified GananciaAdministrivo in storage.
     *
     * @param  int              $id
     * @param UpdateGananciaAdministrivoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGananciaAdministrivoRequest $request)
    {
        $gananciaAdministrivo = $this->gananciaAdministrivoRepository->findWithoutFail($id);

        if (empty($gananciaAdministrivo)) {
            Flash::error('Ganancia Administrivo not found');

            return redirect(route('gananciaAdministrivos.index'));
        }

        $gananciaAdministrivo = $this->gananciaAdministrivoRepository->update($request->all(), $id);

        Flash::success('Ganancia Administrivo Actualizado con exito.');

        return redirect(route('gananciaAdministrivos.index'));
    }

    /**
     * Remove the specified GananciaAdministrivo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $gananciaAdministrivo = $this->gananciaAdministrivoRepository->findWithoutFail($id);

        if (empty($gananciaAdministrivo)) {
            Flash::error('Ganancia Administrivo not found');

            return redirect(route('gananciaAdministrivos.index'));
        }

        $this->gananciaAdministrivoRepository->delete($id);

        Flash::success('Ganancia Administrivo Borrado con exito.');

        return redirect(route('gananciaAdministrivos.index'));
    }
}
