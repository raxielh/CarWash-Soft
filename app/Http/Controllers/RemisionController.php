<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRemisionRequest;
use App\Http\Requests\UpdateRemisionRequest;
use App\Repositories\RemisionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class RemisionController extends AppBaseController
{
    /** @var  RemisionRepository */
    private $remisionRepository;

    public function __construct(RemisionRepository $remisionRepo)
    {
        $this->remisionRepository = $remisionRepo;
    }

    /**
     * Display a listing of the Remision.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->remisionRepository->pushCriteria(new RequestCriteria($request));
        $remisions = $this->remisionRepository->all();

        return view('remisions.index')
            ->with('remisions', $remisions);
    }

    /**
     * Show the form for creating a new Remision.
     *
     * @return Response
     */
    public function create()
    {
        return view('remisions.create');
    }

    /**
     * Store a newly created Remision in storage.
     *
     * @param CreateRemisionRequest $request
     *
     * @return Response
     */
    public function store(CreateRemisionRequest $request)
    {
        $input = $request->all();

        $remision = $this->remisionRepository->create($input);

        Flash::success('Remision Guardado exitosamente.');

        return redirect(route('remisions.index'));
    }

    /**
     * Display the specified Remision.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $remision = $this->remisionRepository->findWithoutFail($id);

        if (empty($remision)) {
            Flash::error('Remision not found');

            return redirect(route('remisions.index'));
        }

        return view('remisions.show')->with('remision', $remision);
    }

    /**
     * Show the form for editing the specified Remision.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $remision = $this->remisionRepository->findWithoutFail($id);

        if (empty($remision)) {
            Flash::error('Remision not found');

            return redirect(route('remisions.index'));
        }

        return view('remisions.edit')->with('remision', $remision);
    }

    /**
     * Update the specified Remision in storage.
     *
     * @param  int              $id
     * @param UpdateRemisionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRemisionRequest $request)
    {
        $remision = $this->remisionRepository->findWithoutFail($id);

        if (empty($remision)) {
            Flash::error('Remision not found');

            return redirect(route('remisions.index'));
        }

        $remision = $this->remisionRepository->update($request->all(), $id);

        Flash::success('Remision Actualizado con exito.');

        return redirect(route('remisions.index'));
    }

    /**
     * Remove the specified Remision from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $remision = $this->remisionRepository->findWithoutFail($id);

        if (empty($remision)) {
            Flash::error('Remision not found');

            return redirect(route('remisions.index'));
        }

        $this->remisionRepository->delete($id);

        Flash::success('Remision Borrado con exito.');

        return redirect(route('remisions.index'));
    }
}
