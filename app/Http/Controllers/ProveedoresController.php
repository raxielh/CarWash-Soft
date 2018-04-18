<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProveedoresRequest;
use App\Http\Requests\UpdateProveedoresRequest;
use App\Repositories\ProveedoresRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Personas;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ProveedoresController extends AppBaseController
{
    /** @var  ProveedoresRepository */
    private $proveedoresRepository;

    public function __construct(ProveedoresRepository $proveedoresRepo)
    {
        $this->proveedoresRepository = $proveedoresRepo;
    }

    /**
     * Display a listing of the Proveedores.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->proveedoresRepository->pushCriteria(new RequestCriteria($request));
        $proveedores = $this->proveedoresRepository->all();

        /*
        $proveedores =  DB::table('proveedores')
        ->join('users', 'proveedores.users_id', '=', 'users.id')
        ->selectRaw('proveedores.*,users.name')
        ->get();
        */

         $proveedores =  DB::table('proveedores')
                ->join('users', 'proveedores.users_id', '=', 'users.id')
                ->join('personas', 'proveedores.persona_id', '=', 'personas.id')
                ->selectRaw('proveedores.*,users.name,personas.nombre as nom,personas.apellido as ape,personas.identificacion as iden')
                ->get();
        return view('proveedores.index')
            ->with('proveedores', $proveedores);


          /*
        return view('proveedores.index')
            ->with('proveedores', $proveedores);
            */
    }

    /**
     * Show the form for creating a new Proveedores.
     *
     * @return Response
     */
    public function create()
    {

        $personas=Personas::pluck('identificacion','id');
        $datos = ['personas' => $personas];
        return view('proveedores.create')->with('datos', $datos);

       // return view('proveedores.create');
    }

    /**
     * Store a newly created Proveedores in storage.
     *
     * @param CreateProveedoresRequest $request
     *
     * @return Response
     */
    public function store(CreateProveedoresRequest $request)
    {
        $input = $request->all();
        $input['users_id']=Auth::id();

        $proveedores = $this->proveedoresRepository->create($input);

        Flash::success('Proveedores  Guardado exitosamente.');

        return redirect(route('proveedores.index'));
    }

    /**
     * Display the specified Proveedores.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        
        $proveedores = $this->proveedoresRepository->findWithoutFail($id);

        if (empty($proveedores)) {
            Flash::error('Proveedores not found');

            return redirect(route('proveedores.index'));
        }

        return view('proveedores.show')->with('proveedores', $proveedores);

 
    }

    /**
     * Show the form for editing the specified Proveedores.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /*
        $proveedores = $this->proveedoresRepository->findWithoutFail($id);

        if (empty($proveedores)) {
            Flash::error('Proveedores not found');

            return redirect(route('proveedores.index'));
        }

        return view('proveedores.edit')->with('proveedores', $proveedores);
        */


       $proveedores = $this->proveedoresRepository->findWithoutFail($id);

        if (empty($proveedores)) {
            Flash::error('proveedores not found');

            return redirect(route('proveedores.index'));
        }

        $personas=Personas::pluck('identificacion','id');
        $datos = ['personas' => $personas,'proveedores'=> $proveedores];
        return view('proveedores.edit')->with('datos', $datos);

    }

    /**
     * Update the specified Proveedores in storage.
     *
     * @param  int              $id
     * @param UpdateProveedoresRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProveedoresRequest $request)
    {
        $proveedores = $this->proveedoresRepository->findWithoutFail($id);

        if (empty($proveedores)) {
            Flash::error('Proveedores not found');

            return redirect(route('proveedores.index'));
        }

        $proveedores = $this->proveedoresRepository->update($request->all(), $id);

        Flash::success('Proveedores Actualizado con exito.');

        return redirect(route('proveedores.index'));
    }

    /**
     * Remove the specified Proveedores from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $proveedores = $this->proveedoresRepository->findWithoutFail($id);

        if (empty($proveedores)) {
            Flash::error('Proveedores not found');

            return redirect(route('proveedores.index'));
        }

        $this->proveedoresRepository->delete($id);

        Flash::success('Proveedores Borrado con exito.');

        return redirect(route('proveedores.index'));
    }
}
