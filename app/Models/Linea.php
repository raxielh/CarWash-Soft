<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class Linea
 * @package App\Models
 * @version April 24, 2018, 1:58 am UTC
 *
 * @property integer marca_id
 * @property char descripcion
 * @property integer users_id
 */
class Linea extends Model
{
    

    public $table = 'lineas';
    

    


    public $fillable = [
        'marca_id',
        'descripcion',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'marca_id' => 'integer',
        'descripcion' => 'string',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'marca_id' => 'required',
        'descripcion' => 'required'
    ];

    
}
