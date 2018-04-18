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

        $comandas =  DB::table('comandas')
                ->join('users', 'comandas.users_id', '=', 'users.id')
                ->join('personas', 'comandas.persona_id', '=', 'personas.id')
                ->join('vehiculos', 'comandas.vehiculo_id', '=', 'vehiculos.id')
                ->join('estado_comandas', 'comandas.estado_id', '=', 'estado_comandas.id')
                ->selectRaw('estado_comandas.*,vehiculos.*,comandas.*,users.name,personas.nombre as nom,personas.apellido as ape,personas.identificacion as iden')
                ->get();

        return view('comandas.index')
            ->with('comandas', $comandas);
    }

    /**
     * Show the form for creating a new Comanda.
     *
     * @return Response
     */
    public function create()
    {
        $personas=Personas::pluck('identificacion','id');
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

        return redirect(route('comandas.index'));
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
        $comandas = $this->comandaRepository->findWithoutFail($id);

        if (empty($comandas)) {
            Flash::error('Comanda not found');

            return redirect(route('comandas.index'));
        }

        return view('comandas.show')->with('comanda', $comandas);




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

        $datos = ['personas' => $personas,'vehiculos'=> $vehiculos,'estadocomanda' =>$estadocomanda,'comandas'=>$comandas];
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
}
