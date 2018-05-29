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

class GraficasController extends AppBaseController
{

    /**
     * Display a listing of the Vehiculos.
     *
     * @param Request $request
     * @return Response
     */

    public function nuevos_clientes()
    {
        $nuevos = DB::select("
SELECT COUNT(*) as cantidad,
DATE_FORMAT(created_at, '%m') AS fecha
FROM
vehiculos
WHERE DATE_FORMAT(created_at, '%Y')='2018' GROUP BY fecha ORDER BY fecha ASC
");
        return $nuevos;

    }   
}
