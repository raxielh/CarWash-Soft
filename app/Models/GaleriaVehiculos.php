<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class GaleriaVehiculos
 * @package App\Models
 * @version April 15, 2018, 4:57 pm UTC
 *
 * @property integer vehiculo_id
 * @property char foto
 * @property integer users_id
 */
class GaleriaVehiculos extends Model
{
    

    public $table = 'galeria_vehiculos';
    

    


    public $fillable = [
        'vehiculo_id',
        'foto',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'vehiculo_id' => 'integer',
        'foto' => 'string',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'vehiculo_id' => 'required',
        'foto' => 'required'
    ];

    
}
