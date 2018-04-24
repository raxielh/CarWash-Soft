<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class Marca
 * @package App\Models
 * @version April 24, 2018, 1:50 am UTC
 *
 * @property char descripcion
 * @property integer users_id
 */
class Marca extends Model
{
    

    public $table = 'marcas';
    

    


    public $fillable = [
        'descripcion',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'descripcion' => 'string',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descripcion' => 'required'
    ];

    
}
