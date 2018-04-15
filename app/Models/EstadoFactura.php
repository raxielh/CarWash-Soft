<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class EstadoFactura
 * @package App\Models
 * @version April 15, 2018, 11:11 pm UTC
 *
 * @property char descripcion
 * @property integer users_id
 */
class EstadoFactura extends Model
{
    

    public $table = 'estado_facturas';
    

    


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
