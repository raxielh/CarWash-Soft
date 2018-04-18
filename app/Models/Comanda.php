<?php

namespace App\Models;

use Eloquent as Model;


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

    
}
