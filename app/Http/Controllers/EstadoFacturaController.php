<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEstadoFacturaRequest;
use App\Http\Requests\UpdateEstadoFacturaRequest;
use App\Repositories\EstadoFacturaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstadoFacturaController extends AppBaseController
{
    /** @var  EstadoFacturaRepository */
    private $estadoFacturaRepository;

    public function __construct(EstadoFacturaRepository $estadoFacturaRepo)
    {
        $this->estadoFacturaRepository = $estadoFacturaRepo;
    }

    /**
     * Display a listing of the EstadoFactura.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
      //  $this->estadoFacturaRepository->pushCriteria(new RequestCriteria($request));
      //  $estadoFacturas = $this->estadoFacturaRepository->all();
        $estadoFactura =  DB::table('estado_facturas')
                        ->join('users', 'estado_facturas.users_id', '=', 'users.id')
                        ->selectRaw('estado_facturas.*,users.name')
                        ->get();
        return view('estado_facturas.index')
            ->with('estadoFacturas', $estadoFactura);
    }

    /**
     * Show the form for creating a new EstadoFactura.
     *
     * @return Response
     */
    public function create()
    {
        return view('estado_facturas.create');
    }

    /**
     * Store a newly created EstadoFactura in storage.
     *
     * @param CreateEstadoFacturaRequest $request
     *
     * @return Response
     */
    public function store(CreateEstadoFacturaRequest $request)
    {
        $input = $request->all();
        $input['users_id']=Auth::id();

        $estadoFactura = $this->estadoFacturaRepository->create($input);

        Flash::success('Estado Factura  Guardado exitosamente.');

        return redirect(route('estadoFacturas.index'));
    }

    /**
     * Display the specified EstadoFactura.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $estadoFactura = $this->estadoFacturaRepository->findWithoutFail($id);


        if (empty($estadoFactura)) {
            Flash::error('Estado Factura not found');

            return redirect(route('estadoFacturas.index'));
        }

        return view('estado_facturas.show')->with('estadoFactura', $estadoFactura);
    }

    /**
     * Show the form for editing the specified EstadoFactura.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $estadoFactura = $this->estadoFacturaRepository->findWithoutFail($id);

        if (empty($estadoFactura)) {
            Flash::error('Estado Factura not found');

            return redirect(route('estadoFacturas.index'));
        }

        return view('estado_facturas.edit')->with('estadoFactura', $estadoFactura);
    }

    /**
     * Update the specified EstadoFactura in storage.
     *
     * @param  int              $id
     * @param UpdateEstadoFacturaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEstadoFacturaRequest $request)
    {
        $estadoFactura = $this->estadoFacturaRepository->findWithoutFail($id);

        if (empty($estadoFactura)) {
            Flash::error('Estado Factura not found');

            return redirect(route('estadoFacturas.index'));
        }

        $estadoFactura = $this->estadoFacturaRepository->update($request->all(), $id);

        Flash::success('Estado Factura Actualizado con exito.');

        return redirect(route('estadoFacturas.index'));
    }

    /**
     * Remove the specified EstadoFactura from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $estadoFactura = $this->estadoFacturaRepository->findWithoutFail($id);

        if (empty($estadoFactura)) {
            Flash::error('Estado Factura not found');

            return redirect(route('estadoFacturas.index'));
        }

        $this->estadoFacturaRepository->delete($id);

        Flash::success('Estado Factura Borrado con exito.');

        return redirect(route('estadoFacturas.index'));
    }
}
