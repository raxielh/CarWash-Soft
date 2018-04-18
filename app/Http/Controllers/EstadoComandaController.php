<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEstadoComandaRequest;
use App\Http\Requests\UpdateEstadoComandaRequest;
use App\Repositories\EstadoComandaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstadoComandaController extends AppBaseController
{
    /** @var  EstadoComandaRepository */
    private $estadoComandaRepository;

    public function __construct(EstadoComandaRepository $estadoComandaRepo)
    {
        $this->estadoComandaRepository = $estadoComandaRepo;
    }

    /**
     * Display a listing of the EstadoComanda.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->estadoComandaRepository->pushCriteria(new RequestCriteria($request));
        $estadoComandas = $this->estadoComandaRepository->all();

        $estadoComandas =  DB::table('estado_comandas')
        ->join('users', 'estado_comandas.users_id', '=', 'users.id')
        ->selectRaw('estado_comandas.*,users.name')
        ->get();

        return view('estado_comandas.index')
            ->with('estadoComandas', $estadoComandas);
    }

    /**
     * Show the form for creating a new EstadoComanda.
     *
     * @return Response
     */
    public function create()
    {
        return view('estado_comandas.create');
    }

    /**
     * Store a newly created EstadoComanda in storage.
     *
     * @param CreateEstadoComandaRequest $request
     *
     * @return Response
     */
    public function store(CreateEstadoComandaRequest $request)
    {
        $input = $request->all();
        $input['users_id']=Auth::id();

        $estadoComanda = $this->estadoComandaRepository->create($input);

        Flash::success('Estado Comanda  Guardado exitosamente.');

        return redirect(route('estadoComandas.index'));
    }

    /**
     * Display the specified EstadoComanda.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $estadoComanda = $this->estadoComandaRepository->findWithoutFail($id);

        if (empty($estadoComanda)) {
            Flash::error('Estado Comanda not found');

            return redirect(route('estadoComandas.index'));
        }

        return view('estado_comandas.show')->with('estadoComanda', $estadoComanda);
    }

    /**
     * Show the form for editing the specified EstadoComanda.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $estadoComanda = $this->estadoComandaRepository->findWithoutFail($id);

        if (empty($estadoComanda)) {
            Flash::error('Estado Comanda not found');

            return redirect(route('estadoComandas.index'));
        }

        return view('estado_comandas.edit')->with('estadoComanda', $estadoComanda);
    }

    /**
     * Update the specified EstadoComanda in storage.
     *
     * @param  int              $id
     * @param UpdateEstadoComandaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEstadoComandaRequest $request)
    {
        $estadoComanda = $this->estadoComandaRepository->findWithoutFail($id);

        if (empty($estadoComanda)) {
            Flash::error('Estado Comanda not found');

            return redirect(route('estadoComandas.index'));
        }

        $estadoComanda = $this->estadoComandaRepository->update($request->all(), $id);

        Flash::success('Estado Comanda Actualizado con exito.');

        return redirect(route('estadoComandas.index'));
    }

    /**
     * Remove the specified EstadoComanda from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $estadoComanda = $this->estadoComandaRepository->findWithoutFail($id);

        if (empty($estadoComanda)) {
            Flash::error('Estado Comanda not found');

            return redirect(route('estadoComandas.index'));
        }

        $this->estadoComandaRepository->delete($id);

        Flash::success('Estado Comanda Borrado con exito.');

        return redirect(route('estadoComandas.index'));
    }
}
