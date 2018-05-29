<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class Vehiculos
 * @package App\Models
 * @version April 13, 2018, 5:33 pm UTC
 *
 * @property integer persona_id
 * @property char placa
 * @property char modelo
 * @property char color
 * @property integer users_id
 */
class Vehiculos extends Model
{
    

    public $table = 'vehiculos';
    

    


    public $fillable = [
        'persona_id',
        'placa',
        'modelo',
        'color',
        'users_id',
        'marcas_id',
        'lineas_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'persona_id' => 'integer',
        'placa' => 'string',
        'modelo' => 'string',
        'color' => 'string',
        'users_id' => 'integer',
        'marcas_id' => 'integer',
        'lineas_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'persona_id' => 'required',
        'placa' => 'required|unique:vehiculos'
    ];

    
}
