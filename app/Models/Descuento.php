<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class Descuento
 * @package App\Models
 * @version April 16, 2018, 12:38 am UTC
 *
 * @property char codigo
 * @property char descripcion
 * @property integer porcentaje
 * @property integer users_id
 */
class Descuento extends Model
{
    

    public $table = 'descuentos';
    

    


    public $fillable = [
        'codigo',
        'descripcion',
        'porcentaje',
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
        'porcentaje' => 'integer',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo' => 'required',
        'descripcion' => 'required',
        'porcentaje' => 'required'
    ];

    
}
