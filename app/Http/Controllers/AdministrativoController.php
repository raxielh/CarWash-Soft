<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdministrativoRequest;
use App\Http\Requests\UpdateAdministrativoRequest;
use App\Repositories\AdministrativoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AdministrativoController extends AppBaseController
{
    /** @var  AdministrativoRepository */
    private $administrativoRepository;

    public function __construct(AdministrativoRepository $administrativoRepo)
    {
        $this->administrativoRepository = $administrativoRepo;
    }

    /**
     * Display a listing of the Administrativo.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->administrativoRepository->pushCriteria(new RequestCriteria($request));
        $administrativos = $this->administrativoRepository->all();

        return view('administrativos.index')
            ->with('administrativos', $administrativos);
    }

    /**
     * Show the form for creating a new Administrativo.
     *
     * @return Response
     */
    public function create()
    {
        return view('administrativos.create');
    }

    /**
     * Store a newly created Administrativo in storage.
     *
     * @param CreateAdministrativoRequest $request
     *
     * @return Response
     */
    public function store(CreateAdministrativoRequest $request)
    {
        $input = $request->all();

        $administrativo = $this->administrativoRepository->create($input);

        Flash::success('Administrativo Guardado exitosamente.');

        return redirect(route('administrativos.index'));
    }

    /**
     * Display the specified Administrativo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $administrativo = $this->administrativoRepository->findWithoutFail($id);

        if (empty($administrativo)) {
            Flash::error('Administrativo not found');

            return redirect(route('administrativos.index'));
        }

        return view('administrativos.show')->with('administrativo', $administrativo);
    }

    /**
     * Show the form for editing the specified Administrativo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $administrativo = $this->administrativoRepository->findWithoutFail($id);

        if (empty($administrativo)) {
            Flash::error('Administrativo not found');

            return redirect(route('administrativos.index'));
        }

        return view('administrativos.edit')->with('administrativo', $administrativo);
    }

    /**
     * Update the specified Administrativo in storage.
     *
     * @param  int              $id
     * @param UpdateAdministrativoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdministrativoRequest $request)
    {
        $administrativo = $this->administrativoRepository->findWithoutFail($id);

        if (empty($administrativo)) {
            Flash::error('Administrativo not found');

            return redirect(route('administrativos.index'));
        }

        $administrativo = $this->administrativoRepository->update($request->all(), $id);

        Flash::success('Administrativo Actualizado con exito.');

        return redirect(route('administrativos.index'));
    }

    /**
     * Remove the specified Administrativo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $administrativo = $this->administrativoRepository->findWithoutFail($id);

        if (empty($administrativo)) {
            Flash::error('Administrativo not found');

            return redirect(route('administrativos.index'));
        }

        $this->administrativoRepository->delete($id);

        Flash::success('Administrativo Borrado con exito.');

        return redirect(route('administrativos.index'));
    }
}
