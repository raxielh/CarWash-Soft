<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateValoresConceptoRequest;
use App\Http\Requests\UpdateValoresConceptoRequest;
use App\Repositories\ValoresConceptoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Conceptos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class ValoresConceptoController extends AppBaseController
{
    /** @var  ValoresConceptoRepository */
    private $valoresConceptoRepository;

    public function __construct(ValoresConceptoRepository $valoresConceptoRepo)
    {
        $this->valoresConceptoRepository = $valoresConceptoRepo;
    }

    /**
     * Display a listing of the ValoresConcepto.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $valoresConceptos =  DB::table('valores_conceptos')
                ->join('users', 'valores_conceptos.users_id', '=', 'users.id')
                ->join('conceptos', 'valores_conceptos.concepto_id', '=', 'conceptos.id')
                ->selectRaw('valores_conceptos.*,users.name,conceptos.descripcion as des')
                ->get();

        return view('valores_conceptos.index')
            ->with('valoresConceptos', $valoresConceptos);
    }

    /**
     * Show the form for creating a new ValoresConcepto.
     *
     * @return Response
     */
    public function create()
    {
        $Conceptos=Conceptos::pluck('descripcion','id');
        $datos = ['conceptos'=> $Conceptos];
        return view('valores_conceptos.create')->with('datos', $datos);
    }

    /**
     * Store a newly created ValoresConcepto in storage.
     *
     * @param CreateValoresConceptoRequest $request
     *
     * @return Response
     */
    public function store(CreateValoresConceptoRequest $request)
    {
        $input = $request->all();
        $input['users_id']=Auth::id();

        $valoresConcepto = $this->valoresConceptoRepository->create($input);

        Flash::success('Valores Concepto Guardado exitosamente.');

        return redirect(route('valoresConceptos.index'));
    }

    /**
     * Display the specified ValoresConcepto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $valoresConcepto = $this->valoresConceptoRepository->findWithoutFail($id);

        if (empty($valoresConcepto)) {
            Flash::error('Valores Concepto not found');

            return redirect(route('valoresConceptos.index'));
        }

        return view('valores_conceptos.show')->with('valoresConcepto', $valoresConcepto);
    }

    /**
     * Show the form for editing the specified ValoresConcepto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $valoresConcepto = $this->valoresConceptoRepository->findWithoutFail($id);

        if (empty($valoresConcepto)) {
            Flash::error('Valores Concepto not found');

            return redirect(route('valoresConceptos.index'));
        }

        $Conceptos=Conceptos::pluck('descripcion','id');
        $datos = ['valoresConcepto' => $valoresConcepto,'conceptos'=> $Conceptos];

        return view('valores_conceptos.edit')->with('datos', $datos);
    }

    /**
     * Update the specified ValoresConcepto in storage.
     *
     * @param  int              $id
     * @param UpdateValoresConceptoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateValoresConceptoRequest $request)
    {
        $valoresConcepto = $this->valoresConceptoRepository->findWithoutFail($id);

        if (empty($valoresConcepto)) {
            Flash::error('Valores Concepto not found');

            return redirect(route('valoresConceptos.index'));
        }

        $valoresConcepto = $this->valoresConceptoRepository->update($request->all(), $id);

        Flash::success('Valores Concepto Actualizado con exito.');

        return redirect(route('valoresConceptos.index'));
    }

    /**
     * Remove the specified ValoresConcepto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $valoresConcepto = $this->valoresConceptoRepository->findWithoutFail($id);

        if (empty($valoresConcepto)) {
            Flash::error('Valores Concepto not found');

            return redirect(route('valoresConceptos.index'));
        }

        $this->valoresConceptoRepository->delete($id);

        Flash::success('Valores Concepto Borrado con exito.');

        return redirect(route('valoresConceptos.index'));
    }
}
