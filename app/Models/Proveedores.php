<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class Proveedores
 * @package App\Models
 * @version April 16, 2018, 1:55 am UTC
 *
 * @property char codigo
 * @property integer persona_id
 * @property char razon_social
 * @property char nit
 * @property char direccion
 * @property char telefono2
 * @property char telefono1
 * @property integer users_id
 */
class Proveedores extends Model
{
    

    public $table = 'proveedores';
    

    


    public $fillable = [
        'codigo',
        'persona_id',
        'razon_social',
        'nit',
        'direccion',
        'telefono2',
        'telefono1',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'codigo' => 'string',
        'persona_id' => 'integer',
        'razon_social' => 'string',
        'nit' => 'string',
        'direccion' => 'string',
        'telefono2' => 'string',
        'telefono1' => 'string',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo' => 'required',
        'persona_id' => 'required',
        'razon_social' => 'required',
        'nit' => 'required'
    ];

    
}
