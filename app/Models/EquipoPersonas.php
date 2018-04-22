<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class EquipoPersonas
 * @package App\Models
 * @version April 22, 2018, 12:41 am UTC
 *
 * @property integer equipo_id
 * @property integer persona_id
 * @property integer estado_id
 * @property integer users_id
 */
class EquipoPersonas extends Model
{
    

    public $table = 'equipo_personas';
    

    


    public $fillable = [
        'equipo_id',
        'persona_id',
        'estado_id',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'equipo_id' => 'integer',
        'persona_id' => 'integer',
        'estado_id' => 'integer',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'persona_id' => 'required',
        'estado_id' => 'required'
    ];

    
}
