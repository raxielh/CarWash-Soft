<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Comanda
 * @package App\Models
 * @version April 18, 2018, 3:21 am UTC
 *
 * @property integer persona_id
 * @property integer vehiculo_id
 * @property integer estado_id
 * @property char observacion
 * @property integer users_id
 */
class Comanda extends Model
{
    

    public $table = 'comandas';
    

    


    public $fillable = [
        'persona_id',
        'vehiculo_id',
        'estado_id',
        'observacion',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'persona_id' => 'integer',
        'vehiculo_id' => 'integer',
        'estado_id' => 'integer',
        'observacion' => 'string',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'persona_id' => 'required',
        'vehiculo_id' => 'required',
        'estado_id' => 'required'
    ];

    public function scopeComanda($query, $placa,$estado)
    {
        
        if($placa == "" && $estado ==""){
            return $query
                        ->join('users', 'comandas.users_id', '=', 'users.id')
                        ->join('personas', 'comandas.persona_id', '=', 'personas.id')
                        ->join('vehiculos', 'comandas.vehiculo_id', '=', 'vehiculos.id')
                        ->join('estado_comandas', 'comandas.estado_id', '=', 'estado_comandas.id')
                        ->where(DB::raw('DATE_FORMAT(comandas.created_at, "%Y-%m-%d")'),"=",date("Y-m-d"))
                        ->selectRaw('estado_comandas.descripcion as estadodesc,vehiculos.*,comandas.*,users.name,personas.nombre as nom,personas.apellido as ape,personas.identificacion as iden')
                        ->orderBy('comandas.id', 'desc');
        }else{
            return $query
            #$query
                        ->join('users', 'comandas.users_id', '=', 'users.id')
                        ->join('personas', 'comandas.persona_id', '=', 'personas.id')
                        ->join('vehiculos', 'comandas.vehiculo_id', '=', 'vehiculos.id')
                        ->join('estado_comandas', 'comandas.estado_id', '=', 'estado_comandas.id')
                        ->where('vehiculos.placa',"LIKE","%$placa%")
                        ->where('comandas.estado_id',"=","$estado")
                        ->where(DB::raw('DATE_FORMAT(comandas.created_at, "%Y-%m-%d")'),"=",date("Y-m-d"))
                        ->selectRaw('estado_comandas.descripcion as estadodesc,vehiculos.*,comandas.*,users.name,personas.nombre as nom,personas.apellido as ape,personas.identificacion as iden')
                        ->orderBy('comandas.id', 'desc');
            #dd($query);
        }

        
    }  

    public function scopeComanda_h($query, $placa,$estado)
    {
        
        if($placa == "" && $estado ==""){
            return $query
                        ->join('users', 'comandas.users_id', '=', 'users.id')
                        ->join('personas', 'comandas.persona_id', '=', 'personas.id')
                        ->join('vehiculos', 'comandas.vehiculo_id', '=', 'vehiculos.id')
                        ->join('estado_comandas', 'comandas.estado_id', '=', 'estado_comandas.id')
                        ->selectRaw('estado_comandas.descripcion as estadodesc,vehiculos.*,comandas.*,users.name,personas.nombre as nom,personas.apellido as ape,personas.identificacion as iden,comandas.created_at as fecha')
                        ->orderBy('comandas.id', 'desc');
        }else{
            return $query
            #$query
                        ->join('users', 'comandas.users_id', '=', 'users.id')
                        ->join('personas', 'comandas.persona_id', '=', 'personas.id')
                        ->join('vehiculos', 'comandas.vehiculo_id', '=', 'vehiculos.id')
                        ->join('estado_comandas', 'comandas.estado_id', '=', 'estado_comandas.id')
                        ->where('vehiculos.placa',"LIKE","%$placa%")
                        ->where('comandas.estado_id',"=","$estado")
                        ->selectRaw('estado_comandas.descripcion as estadodesc,vehiculos.*,comandas.*,users.name,personas.nombre as nom,personas.apellido as ape,personas.identificacion as iden,comandas.created_at as fecha')
                        ->orderBy('comandas.id', 'desc');
            #dd($query);
        }

        
    }  

}
