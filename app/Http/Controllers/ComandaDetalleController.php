<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateComandaDetalleRequest;
use App\Http\Requests\UpdateComandaDetalleRequest;
use App\Repositories\ComandaDetalleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ComandaDetalleController extends AppBaseController
{
    /** @var  ComandaDetalleRepository */
    private $comandaDetalleRepository;

    public function __construct(ComandaDetalleRepository $comandaDetalleRepo)
    {
        $this->comandaDetalleRepository = $comandaDetalleRepo;
    }

    /**
     * Display a listing of the ComandaDetalle.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->comandaDetalleRepository->pushCriteria(new RequestCriteria($request));
        $comandaDetalles = $this->comandaDetalleRepository->all();

        return view('comanda_detalles.index')
            ->with('comandaDetalles', $comandaDetalles);
    }

    /**
     * Show the form for creating a new ComandaDetalle.
     *
     * @return Response
     */
    public function create()
    {
        return view('comanda_detalles.create');
    }

    /**
     * Store a newly created ComandaDetalle in storage.
     *
     * @param CreateComandaDetalleRequest $request
     *
     * @return Response
     */
    public function store(CreateComandaDetalleRequest $request)
    {
        $input = $request->all();
        $input['users_id']=Auth::id();

        $comandaDetalle = $this->comandaDetalleRepository->create($input);

        Flash::success('Comanda Detalle Guardado exitosamente.');

        //return redirect(route('comandaDetalles.index'));
        return back();
    }

    /**
     * Display the specified ComandaDetalle.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $comandaDetalle = $this->comandaDetalleRepository->findWithoutFail($id);

        if (empty($comandaDetalle)) {
            Flash::error('Comanda Detalle not found');

            return redirect(route('comandaDetalles.index'));
        }

        return view('comanda_detalles.show')->with('comandaDetalle', $comandaDetalle);
    }

    /**
     * Show the form for editing the specified ComandaDetalle.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $comandaDetalle = $this->comandaDetalleRepository->findWithoutFail($id);

        if (empty($comandaDetalle)) {
            Flash::error('Comanda Detalle not found');

            return redirect(route('comandaDetalles.index'));
        }

        return view('comanda_detalles.edit')->with('comandaDetalle', $comandaDetalle);
    }

    /**
     * Update the specified ComandaDetalle in storage.
     *
     * @param  int              $id
     * @param UpdateComandaDetalleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateComandaDetalleRequest $request)
    {
        $comandaDetalle = $this->comandaDetalleRepository->findWithoutFail($id);

        if (empty($comandaDetalle)) {
            Flash::error('Comanda Detalle not found');

            return redirect(route('comandaDetalles.index'));
        }

        $comandaDetalle = $this->comandaDetalleRepository->update($request->all(), $id);

        Flash::success('Comanda Detalle Actualizado con exito.');

        return redirect(route('comandaDetalles.index'));
    }

    /**
     * Remove the specified ComandaDetalle from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $comandaDetalle = $this->comandaDetalleRepository->findWithoutFail($id);

        if (empty($comandaDetalle)) {
            Flash::error('Comanda Detalle not found');

            return redirect(route('comandaDetalles.index'));
        }

        $this->comandaDetalleRepository->delete($id);

        Flash::success('Comanda Detalle Borrado con exito.');

        //return redirect(route('comandaDetalles.index'));
        return back();
    }
}
