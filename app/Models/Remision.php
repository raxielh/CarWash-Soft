<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class Remision
 * @package App\Models
 * @version May 12, 2018, 7:58 pm UTC
 *
 * @property char descripcion
 * @property integer persona_id
 * @property integer proveedor_id
 * @property integer concepto_id
 * @property integer tipo_remision_id
 * @property date fecha
 * @property integer valor
 * @property integer users_id
 */
class Remision extends Model
{
    

    public $table = 'remisions';
    

    


    public $fillable = [
        'descripcion',
        'persona_id',
        'proveedor_id',
        'concepto_id',
        'tipo_remision_id',
        'fecha',
        'valor',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'descripcion' => 'string',
        'persona_id' => 'integer',
        'proveedor_id' => 'integer',
        'concepto_id' => 'integer',
        'tipo_remision_id' => 'integer',
        'fecha' => 'date',
        'valor' => 'integer',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descripcion' => 'required',
        'persona_id' => 'required',
        'proveedor_id' => 'required',
        'concepto_id' => 'required',
        'tipo_remision_id' => 'required',
        'fecha' => 'required',
        'valor' => 'required',
        'users_id' => 'required'
    ];

    
}
