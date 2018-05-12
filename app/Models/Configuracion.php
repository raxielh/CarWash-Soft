<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class Configuracion
 * @package App\Models
 * @version May 12, 2018, 11:14 pm UTC
 *
 * @property integer concepto_admin_gasto
 * @property integer concepto_lavador_gasto
 */
class Configuracion extends Model
{
    

    public $table = 'configuracions';
    

    


    public $fillable = [
        'concepto_admin_gasto',
        'concepto_lavador_gasto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'concepto_admin_gasto' => 'integer',
        'concepto_lavador_gasto' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'concepto_admin_gasto' => 'required',
        'concepto_lavador_gasto' => 'required'
    ];

    
}
