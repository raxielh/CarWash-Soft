<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class Equipos
 * @package App\Models
 * @version April 15, 2018, 8:19 pm UTC
 *
 * @property char codigo
 * @property char descripcion
 * @property integer users_id
 */
class Equipos extends Model
{
    

    public $table = 'equipos';
    

    


    public $fillable = [
        'codigo',
        'descripcion',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'codigo' => 'string',
        'descripcion' => 'string',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo' => 'required|unique:equipos',
        'descripcion' => 'required|unique:equipos'
    ];

    
}
