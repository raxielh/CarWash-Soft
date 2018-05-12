<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class ComandaDetalle
 * @package App\Models
 * @version April 20, 2018, 4:29 pm UTC
 *
 * @property integer comanda_id
 * @property integer concepto_id
 * @property integer descuentos_id
 * @property char valor
 * @property integer users_id
 */
class ComandaDetalle extends Model
{
    

    public $table = 'comanda_detalles';
    

    


    public $fillable = [
        'comanda_id',
        'concepto_id',
        'cantidad',
        'descuentos_id',
        'descuento',
        'valor',
        'comision',
        'impuesto',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'comanda_id' => 'integer',
        'concepto_id' => 'integer',
        'cantidad' => 'integer',
        'descuentos_id' => 'integer',
        'descuento' => 'integer',
        'valor' => 'string',
        'comision' => 'integer',
        'impuesto' => 'integer',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'concepto_id' => 'required',
        'cantidad' => 'required',
        'descuentos_id' => 'required',
        'valor' => 'required'
    ];

    
}
