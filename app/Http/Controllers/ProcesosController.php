<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVehiculosRequest;
use App\Http\Requests\UpdateVehiculosRequest;
use App\Repositories\VehiculosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Personas;
use App\Models\Vehiculos;
use App\Models\Marca;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProcesosController extends AppBaseController
{

    /**
     * Display a listing of the Vehiculos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('procesos.index');
    }

    public function Administrativo(Request $request)
    {
        $fecha=$request->fecha;
        $dato=DB::select('select FnCalculaAdministradorLava("'.$fecha.'") AS salida');
        return view('procesos.msg')->with('dato', $dato);
    }

    public function Lavadero(Request $request)
    {
        $fecha=$request->fecha;
        // $dato=DB::select('CALL ProCalculaComisionLava(?)',array($fecha));
        $dato=DB::select("select FnCalculaComisionLava('".$fecha."') as salida");
        return view('procesos.msg')->with('dato', $dato);
    }

    public function Cargar(Request $request)
    {
        $fecha=$request->fecha;
        $dato=DB::select("select FnCalculaCierre('".$fecha."') as salida");
        return view('procesos.msg')->with('dato', $dato);
    }    

}
