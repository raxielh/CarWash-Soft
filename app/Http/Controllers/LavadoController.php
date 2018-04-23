<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLavadoRequest;
use App\Http\Requests\UpdateLavadoRequest;
use App\Repositories\LavadoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LavadoController extends AppBaseController
{
    /** @var  LavadoRepository */
    private $lavadoRepository;

    public function __construct(LavadoRepository $lavadoRepo)
    {
        $this->lavadoRepository = $lavadoRepo;
    }

    /**
     * Display a listing of the Lavado.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->lavadoRepository->pushCriteria(new RequestCriteria($request));
        $lavados = $this->lavadoRepository->all();

        return view('lavados.index')
            ->with('lavados', $lavados);
    }

    /**
     * Show the form for creating a new Lavado.
     *
     * @return Response
     */
    public function create()
    {
        return view('lavados.create');
    }

    /**
     * Store a newly created Lavado in storage.
     *
     * @param CreateLavadoRequest $request
     *
     * @return Response
     */
    public function store(CreateLavadoRequest $request)
    {
        $input = $request->all();
        $input['users_id']=Auth::id();

        $lavado = $this->lavadoRepository->create($input);

        Flash::success('Lavado Guardado exitosamente.');

        //return redirect(route('lavados.index'));
        return back();
    }

    /**
     * Display the specified Lavado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $lavados = DB::table('lavados')
                ->join('equipos', 'lavados.equipo_id', '=', 'equipos.id')
                ->where('comanda_id',$id)
                ->selectRaw('lavados.*,equipos.descripcion as equipo,equipos.codigo as codigo')
                ->get();

        $equipos = DB::table('equipos')
            ->select(DB::raw('CONCAT(codigo, " ", descripcion) AS descripcion'), 'id')
            ->pluck('descripcion','id');

        $datos = [
                    'id' => $id,
                    'equipos' => $equipos,
                    'lavados' => $lavados,
                ];

        return view('lavados.create')->with('datos', $datos);
    }

    /**
     * Show the form for editing the specified Lavado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $lavado = $this->lavadoRepository->findWithoutFail($id);

        if (empty($lavado)) {
            Flash::error('Lavado not found');

            return redirect(route('lavados.index'));
        }

        return view('lavados.edit')->with('lavado', $lavado);
    }

    /**
     * Update the specified Lavado in storage.
     *
     * @param  int              $id
     * @param UpdateLavadoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLavadoRequest $request)
    {
        $lavado = $this->lavadoRepository->findWithoutFail($id);

        if (empty($lavado)) {
            Flash::error('Lavado not found');

            return redirect(route('lavados.index'));
        }

        $lavado = $this->lavadoRepository->update($request->all(), $id);

        Flash::success('Lavado Actualizado con exito.');

        return redirect(route('lavados.index'));
    }

    /**
     * Remove the specified Lavado from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $lavado = $this->lavadoRepository->findWithoutFail($id);

        if (empty($lavado)) {
            Flash::error('Lavado not found');

            return redirect(route('lavados.index'));
        }

        $this->lavadoRepository->delete($id);

        Flash::success('Lavado Borrado con exito.');

        //return redirect(route('lavados.index'));
        return back();
    }
}
