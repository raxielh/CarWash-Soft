<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDescuentoRequest;
use App\Http\Requests\UpdateDescuentoRequest;
use App\Repositories\DescuentoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DescuentoController extends AppBaseController
{
    /** @var  DescuentoRepository */
    private $descuentoRepository;

    public function __construct(DescuentoRepository $descuentoRepo)
    {
        $this->descuentoRepository = $descuentoRepo;
    }

    /**
     * Display a listing of the Descuento.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->descuentoRepository->pushCriteria(new RequestCriteria($request));
        $descuentos = $this->descuentoRepository->all();

        $descuentos =  DB::table('descuentos')
        ->join('users', 'descuentos.users_id', '=', 'users.id')
        ->selectRaw('descuentos.*,users.name')
        ->get();

        return view('descuentos.index')
            ->with('descuentos', $descuentos);
    }

    /**
     * Show the form for creating a new Descuento.
     *
     * @return Response
     */
    public function create()
    {
        return view('descuentos.create');
    }

    /**
     * Store a newly created Descuento in storage.
     *
     * @param CreateDescuentoRequest $request
     *
     * @return Response
     */
    public function store(CreateDescuentoRequest $request)
    {
        $input = $request->all();
        $input['users_id']=Auth::id();

        $descuento = $this->descuentoRepository->create($input);

        Flash::success('Descuento Guardado exitosamente.');

        return redirect(route('descuentos.index'));
    }

    /**
     * Display the specified Descuento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $descuento = $this->descuentoRepository->findWithoutFail($id);

        if (empty($descuento)) {
            Flash::error('Descuento not found');

            return redirect(route('descuentos.index'));
        }

        return view('descuentos.show')->with('descuento', $descuento);
    }

    /**
     * Show the form for editing the specified Descuento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $descuento = $this->descuentoRepository->findWithoutFail($id);

        if (empty($descuento)) {
            Flash::error('Descuento not found');

            return redirect(route('descuentos.index'));
        }

        return view('descuentos.edit')->with('descuento', $descuento);
    }

    /**
     * Update the specified Descuento in storage.
     *
     * @param  int              $id
     * @param UpdateDescuentoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDescuentoRequest $request)
    {
        $descuento = $this->descuentoRepository->findWithoutFail($id);

        if (empty($descuento)) {
            Flash::error('Descuento not found');

            return redirect(route('descuentos.index'));
        }

        $descuento = $this->descuentoRepository->update($request->all(), $id);

        Flash::success('Descuento Actualizado con exito.');

        return redirect(route('descuentos.index'));
    }

    /**
     * Remove the specified Descuento from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $descuento = $this->descuentoRepository->findWithoutFail($id);

        if (empty($descuento)) {
            Flash::error('Descuento not found');

            return redirect(route('descuentos.index'));
        }

        $this->descuentoRepository->delete($id);

        Flash::success('Descuento Borrado con exito.');

        return redirect(route('descuentos.index'));
    }
}
