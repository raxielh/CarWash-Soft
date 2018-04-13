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

class VehiculosController extends AppBaseController
{
    /** @var  VehiculosRepository */
    private $vehiculosRepository;

    public function __construct(VehiculosRepository $vehiculosRepo)
    {
        $this->vehiculosRepository = $vehiculosRepo;
    }

    /**
     * Display a listing of the Vehiculos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->vehiculosRepository->pushCriteria(new RequestCriteria($request));
        $vehiculos = $this->vehiculosRepository->all();

        return view('vehiculos.index')
            ->with('vehiculos', $vehiculos);
    }

    /**
     * Show the form for creating a new Vehiculos.
     *
     * @return Response
     */
    public function create()
    {
        return view('vehiculos.create');
    }

    /**
     * Store a newly created Vehiculos in storage.
     *
     * @param CreateVehiculosRequest $request
     *
     * @return Response
     */
    public function store(CreateVehiculosRequest $request)
    {
        $input = $request->all();

        $vehiculos = $this->vehiculosRepository->create($input);

        Flash::success('Vehiculos Guardado exitosamente.');

        return redirect(route('vehiculos.index'));
    }

    /**
     * Display the specified Vehiculos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vehiculos = $this->vehiculosRepository->findWithoutFail($id);

        if (empty($vehiculos)) {
            Flash::error('Vehiculos not found');

            return redirect(route('vehiculos.index'));
        }

        return view('vehiculos.show')->with('vehiculos', $vehiculos);
    }

    /**
     * Show the form for editing the specified Vehiculos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vehiculos = $this->vehiculosRepository->findWithoutFail($id);

        if (empty($vehiculos)) {
            Flash::error('Vehiculos not found');

            return redirect(route('vehiculos.index'));
        }

        return view('vehiculos.edit')->with('vehiculos', $vehiculos);
    }

    /**
     * Update the specified Vehiculos in storage.
     *
     * @param  int              $id
     * @param UpdateVehiculosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVehiculosRequest $request)
    {
        $vehiculos = $this->vehiculosRepository->findWithoutFail($id);

        if (empty($vehiculos)) {
            Flash::error('Vehiculos not found');

            return redirect(route('vehiculos.index'));
        }

        $vehiculos = $this->vehiculosRepository->update($request->all(), $id);

        Flash::success('Vehiculos Actualizado con exito.');

        return redirect(route('vehiculos.index'));
    }

    /**
     * Remove the specified Vehiculos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vehiculos = $this->vehiculosRepository->findWithoutFail($id);

        if (empty($vehiculos)) {
            Flash::error('Vehiculos not found');

            return redirect(route('vehiculos.index'));
        }

        $this->vehiculosRepository->delete($id);

        Flash::success('Vehiculos Borrado con exito.');

        return redirect(route('vehiculos.index'));
    }
}
