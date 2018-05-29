<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class Conceptos
 * @package App\Models
 * @version April 8, 2018, 3:18 pm UTC
 *
 * @property char codigo
 * @property mediumText descripcion
 * @property integer tipo_conceptos_id
 * @property integer estado_id
 * @property integer users_id
 */
class Conceptos extends Model
{
    

    public $table = 'conceptos';
    

    


    public $fillable = [
        'codigo',
        'descripcion',
        'tipo_conceptos_id',
        'comision',
        'impuesto',
        'estado_id',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'codigo' => 'string',
        'tipo_conceptos_id' => 'integer',
        'comision'=> 'integer',
        'impuesto'=> 'integer',
        'estado_id' => 'integer',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo' => 'required|unique:conceptos',
        'descripcion' => 'required|unique:conceptos',
        'tipo_conceptos_id' => 'required',
        'comision'=> 'required',
        'impuesto'=> 'required',
        'estado_id' => 'required'
    ];

    
}
