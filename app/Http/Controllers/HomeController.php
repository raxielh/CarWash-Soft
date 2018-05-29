<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $nuevos = DB::select("
                                SELECT COUNT(*) as cantidad,
                                DATE_FORMAT(created_at, '%m') AS fecha
                                FROM
                                vehiculos
                                WHERE DATE_FORMAT(created_at, '%Y')='".date('Y')."' GROUP BY fecha ORDER BY fecha ASC
                            ");
        $servicios = DB::select("
                                SELECT COUNT(*) cantidad,DATE_FORMAT(created_at, '%m') AS fecha
                                FROM comandas WHERE DATE_FORMAT(created_at, '%Y')='".date('Y')."' GROUP BY fecha ORDER BY fecha ASC
                            ");
        $basegancia = DB::select("
                                    SELECT
                                    valor_inicia,valor_cierre,valor_ventas_cafeteria,valor_ventas_servicios,valor_salidas_remisiones,valor_entrada_remisiones,fecha
                                    FROM
                                    basegancia
                                    WHERE DATE_FORMAT(created_at, '%Y')='".date('Y')."' 
                                    ORDER BY fecha ASC
                            ");

        return view('home')
                            ->with('nuevos',$nuevos)
                            ->with('basegancia',$basegancia)
                            ->with('servicios',$servicios);
    
    }
}
