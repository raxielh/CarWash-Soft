<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMarcaRequest;
use App\Http\Requests\UpdateMarcaRequest;
use App\Repositories\MarcaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MarcaController extends AppBaseController
{
    /** @var  MarcaRepository */
    private $marcaRepository;

    public function __construct(MarcaRepository $marcaRepo)
    {
        $this->marcaRepository = $marcaRepo;
    }

    /**
     * Display a listing of the Marca.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        /*
        $this->marcaRepository->pushCriteria(new RequestCriteria($request));
        $marcas = $this->marcaRepository->all();
        */
        $marcas =  DB::table('marcas')
                ->join('users', 'marcas.users_id', '=', 'users.id')
                ->selectRaw('marcas.*,users.name')
                ->get();

        return view('marcas.index')
            ->with('marcas', $marcas);
    }

    /**
     * Show the form for creating a new Marca.
     *
     * @return Response
     */
    public function create()
    {
        return view('marcas.create');
    }

    /**
     * Store a newly created Marca in storage.
     *
     * @param CreateMarcaRequest $request
     *
     * @return Response
     */
    public function store(CreateMarcaRequest $request)
    {
        $input = $request->all();
        $input['users_id']=Auth::id();

        $marca = $this->marcaRepository->create($input);

        Flash::success('Marca Guardado exitosamente.');

        return redirect(route('marcas.index'));
    }

    /**
     * Display the specified Marca.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $marca = $this->marcaRepository->findWithoutFail($id);

        if (empty($marca)) {
            Flash::error('Marca not found');

            return redirect(route('marcas.index'));
        }

        return view('marcas.show')->with('marca', $marca);
    }

    /**
     * Show the form for editing the specified Marca.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $marca = $this->marcaRepository->findWithoutFail($id);

        if (empty($marca)) {
            Flash::error('Marca not found');

            return redirect(route('marcas.index'));
        }

        return view('marcas.edit')->with('marca', $marca);
    }

    /**
     * Update the specified Marca in storage.
     *
     * @param  int              $id
     * @param UpdateMarcaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMarcaRequest $request)
    {
        $marca = $this->marcaRepository->findWithoutFail($id);

        if (empty($marca)) {
            Flash::error('Marca not found');

            return redirect(route('marcas.index'));
        }

        $marca = $this->marcaRepository->update($request->all(), $id);

        Flash::success('Marca Actualizado con exito.');

        return redirect(route('marcas.index'));
    }

    /**
     * Remove the specified Marca from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $marca = $this->marcaRepository->findWithoutFail($id);

        if (empty($marca)) {
            Flash::error('Marca not found');

            return redirect(route('marcas.index'));
        }

        $this->marcaRepository->delete($id);

        Flash::success('Marca Borrado con exito.');

        return redirect(route('marcas.index'));
    }
}
