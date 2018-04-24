<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLineaRequest;
use App\Http\Requests\UpdateLineaRequest;
use App\Repositories\LineaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Marca;

class LineaController extends AppBaseController
{
    /** @var  LineaRepository */
    private $lineaRepository;

    public function __construct(LineaRepository $lineaRepo)
    {
        $this->lineaRepository = $lineaRepo;
    }

    /**
     * Display a listing of the Linea.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        /*
        $this->lineaRepository->pushCriteria(new RequestCriteria($request));
        $lineas = $this->lineaRepository->all();
        */
        $lineas =  DB::table('lineas')
                ->join('users', 'lineas.users_id', '=', 'users.id')
                ->join('marcas', 'lineas.marca_id', '=', 'marcas.id')
                ->selectRaw('lineas.*,users.name,marcas.descripcion as marca')
                ->get();
        return view('lineas.index')
            ->with('lineas', $lineas);
    }

    /**
     * Show the form for creating a new Linea.
     *
     * @return Response
     */
    public function create()
    {
        $marca = Marca::pluck('descripcion','id');
        return view('lineas.create')->with('marca', $marca);
    }

    /**
     * Store a newly created Linea in storage.
     *
     * @param CreateLineaRequest $request
     *
     * @return Response
     */
    public function store(CreateLineaRequest $request)
    {
        $input = $request->all();
        $input['users_id']=Auth::id();

        $linea = $this->lineaRepository->create($input);
 
        Flash::success('Linea Guardado exitosamente.');

        return redirect(route('lineas.index'));
    }

    /**
     * Display the specified Linea.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $linea = $this->lineaRepository->findWithoutFail($id);

        if (empty($linea)) {
            Flash::error('Linea not found');

            return redirect(route('lineas.index'));
        }

        return view('lineas.show')->with('linea', $linea);
    }

    /**
     * Show the form for editing the specified Linea.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $linea = $this->lineaRepository->findWithoutFail($id);

        if (empty($linea)) {
            Flash::error('Linea not found');

            return redirect(route('lineas.index'));
        }

        return view('lineas.edit')->with('linea', $linea);
    }

    /**
     * Update the specified Linea in storage.
     *
     * @param  int              $id
     * @param UpdateLineaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLineaRequest $request)
    {
        $linea = $this->lineaRepository->findWithoutFail($id);

        if (empty($linea)) {
            Flash::error('Linea not found');

            return redirect(route('lineas.index'));
        }

        $linea = $this->lineaRepository->update($request->all(), $id);

        Flash::success('Linea Actualizado con exito.');

        return redirect(route('lineas.index'));
    }

    /**
     * Remove the specified Linea from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $linea = $this->lineaRepository->findWithoutFail($id);

        if (empty($linea)) {
            Flash::error('Linea not found');

            return redirect(route('lineas.index'));
        }

        $this->lineaRepository->delete($id);

        Flash::success('Linea Borrado con exito.');

        return redirect(route('lineas.index'));
    }

    public function marca($id)
    {
        return $lineas =  DB::table('lineas')
                ->where('marca_id',$id)
                ->selectRaw('lineas.id,lineas.descripcion')
                ->get();
    }


}
