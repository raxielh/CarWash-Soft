<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateConfiguracionRequest;
use App\Http\Requests\UpdateConfiguracionRequest;
use App\Repositories\ConfiguracionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\DB;

class ConfiguracionController extends AppBaseController
{
    /** @var  ConfiguracionRepository */
    private $configuracionRepository;

    public function __construct(ConfiguracionRepository $configuracionRepo)
    {
        $this->configuracionRepository = $configuracionRepo;
    }

    /**
     * Display a listing of the Configuracion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->configuracionRepository->pushCriteria(new RequestCriteria($request));
        $configuracions = $this->configuracionRepository->all();

        return view('configuracions.index')
            ->with('configuracions', $configuracions);
    }

    /**
     * Show the form for creating a new Configuracion.
     *
     * @return Response
     */
    public function create()
    {


        $conceptos = DB::table('conceptos')
         ->join('tipo_conceptos', 'conceptos.tipo_conceptos_id', '=', 'tipo_conceptos.id')
                ->where('tipo_conceptos.id',4)
            ->select(DB::raw('CONCAT(conceptos.codigo, " ", conceptos.descripcion) AS descripci'), 'conceptos.id')
            ->pluck('conceptos.descripci','conceptos.id');


        return view('configuracions.create')->with('conceptos', $conceptos);
    }

    /**
     * Store a newly created Configuracion in storage.
     *
     * @param CreateConfiguracionRequest $request
     *
     * @return Response
     */
    public function store(CreateConfiguracionRequest $request)
    {
        $input = $request->all();

        $configuracion = $this->configuracionRepository->create($input);

        Flash::success('Configuracion Guardado exitosamente.');

        return redirect(route('configuracions.index'));
    }

    /**
     * Display the specified Configuracion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $configuracion = $this->configuracionRepository->findWithoutFail($id);

        if (empty($configuracion)) {
            Flash::error('Configuracion not found');

            return redirect(route('configuracions.index'));
        }

        return view('configuracions.show')->with('configuracion', $configuracion);
    }

    /**
     * Show the form for editing the specified Configuracion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $configuracion = $this->configuracionRepository->findWithoutFail($id);

        if (empty($configuracion)) {
            Flash::error('Configuracion not found');

            return redirect(route('configuracions.index'));
        }

        return view('configuracions.edit')->with('configuracion', $configuracion);
    }

    /**
     * Update the specified Configuracion in storage.
     *
     * @param  int              $id
     * @param UpdateConfiguracionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConfiguracionRequest $request)
    {
        $configuracion = $this->configuracionRepository->findWithoutFail($id);

        if (empty($configuracion)) {
            Flash::error('Configuracion not found');

            return redirect(route('configuracions.index'));
        }

        $configuracion = $this->configuracionRepository->update($request->all(), $id);

        Flash::success('Configuracion Actualizado con exito.');

        return redirect(route('configuracions.index'));
    }

    /**
     * Remove the specified Configuracion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $configuracion = $this->configuracionRepository->findWithoutFail($id);

        if (empty($configuracion)) {
            Flash::error('Configuracion not found');

            return redirect(route('configuracions.index'));
        }

        $this->configuracionRepository->delete($id);

        Flash::success('Configuracion Borrado con exito.');

        return redirect(route('configuracions.index'));
    }
}
