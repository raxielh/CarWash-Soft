<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGaleriaVehiculosRequest;
use App\Http\Requests\UpdateGaleriaVehiculosRequest;
use App\Repositories\GaleriaVehiculosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Vehiculos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GaleriaVehiculosController extends AppBaseController
{
    /** @var  GaleriaVehiculosRepository */
    private $galeriaVehiculosRepository;

    public function __construct(GaleriaVehiculosRepository $galeriaVehiculosRepo)
    {
        $this->galeriaVehiculosRepository = $galeriaVehiculosRepo;
    }

    /**
     * Display a listing of the GaleriaVehiculos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $galeriaVehiculos =  DB::table('galeria_vehiculos')
                ->join('users', 'galeria_vehiculos.users_id', '=', 'users.id')
                ->join('vehiculos', 'galeria_vehiculos.vehiculo_id', '=', 'vehiculos.id')
                ->selectRaw('galeria_vehiculos.*,users.name,vehiculos.placa')
                ->get();

        return view('galeria_vehiculos.index')
            ->with('galeriaVehiculos', $galeriaVehiculos);
    }

    /**
     * Show the form for creating a new GaleriaVehiculos.
     *
     * @return Response
     */
    public function create()
    {
        $Vehiculos=Vehiculos::pluck('placa','id');
        $datos = ['vehiculos' => $Vehiculos];
        return view('galeria_vehiculos.create')->with('datos', $datos);
    }

    /**
     * Store a newly created GaleriaVehiculos in storage.
     *
     * @param CreateGaleriaVehiculosRequest $request
     *
     * @return Response
     */
    public function store(CreateGaleriaVehiculosRequest $request)
    {
        $input = $request->all();
        $input['users_id']=Auth::id();
        $input['foto']=$request->file('foto')->store('public');
        $galeriaVehiculos = $this->galeriaVehiculosRepository->create($input);

        Flash::success('Galeria Vehiculos Guardado exitosamente.');

        return redirect(route('galeriaVehiculos.index'));
        
    }

    /**
     * Display the specified GaleriaVehiculos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $galeriaVehiculos = $this->galeriaVehiculosRepository->findWithoutFail($id);

        if (empty($galeriaVehiculos)) {
            Flash::error('Galeria Vehiculos not found');

            return redirect(route('galeriaVehiculos.index'));
        }

        return view('galeria_vehiculos.show')->with('galeriaVehiculos', $galeriaVehiculos);
    }

    /**
     * Show the form for editing the specified GaleriaVehiculos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $galeriaVehiculos = $this->galeriaVehiculosRepository->findWithoutFail($id);

        if (empty($galeriaVehiculos)) {
            Flash::error('Galeria Vehiculos not found');

            return redirect(route('galeriaVehiculos.index'));
        }

        $Vehiculos=Vehiculos::pluck('placa','id');
        $datos = ['vehiculos' => $Vehiculos,'galeria'=> $galeriaVehiculos];
        return view('galeria_vehiculos.edit')->with('datos', $datos);
    }

    /**
     * Update the specified GaleriaVehiculos in storage.
     *
     * @param  int              $id
     * @param UpdateGaleriaVehiculosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGaleriaVehiculosRequest $request)
    {
        $galeriaVehiculos = $this->galeriaVehiculosRepository->findWithoutFail($id);

        if (empty($galeriaVehiculos)) {
            Flash::error('Galeria Vehiculos not found');

            return redirect(route('galeriaVehiculos.index'));
        }
        $request = array(
                            "_method" => $request->_method,
                            "_token"  => $request->_token,
                            "vehiculo_id" => $request->vehiculo_id,
                            "foto"    => $request->file('foto')->store('public')
                        );
        
        $galeriaVehiculos = $this->galeriaVehiculosRepository->update($request, $id);

        Flash::success('Galeria Vehiculos Actualizado con exito.');

        return redirect(route('galeriaVehiculos.index'));
    }

    /**
     * Remove the specified GaleriaVehiculos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $galeriaVehiculos = $this->galeriaVehiculosRepository->findWithoutFail($id);

        if (empty($galeriaVehiculos)) {
            Flash::error('Galeria Vehiculos not found');

            return redirect(route('galeriaVehiculos.index'));
        }

        $this->galeriaVehiculosRepository->delete($id);

        Flash::success('Galeria Vehiculos Borrado con exito.');

        return redirect(route('galeriaVehiculos.index'));
    }
}
