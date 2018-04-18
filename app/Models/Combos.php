<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class Combos
 * @package App\Models
 * @version April 18, 2018, 12:18 am UTC
 *
 * @property integer concepto_id1
 * @property integer concepto_id2
 * @property integer estado_id
 * @property integer users_id
 */
class Combos extends Model
{
    

    public $table = 'combos';
    

    


    public $fillable = [
        'concepto_id1',
        'concepto_id2',
        'estado_id',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'concepto_id1' => 'integer',
        'concepto_id2' => 'integer',
        'estado_id' => 'integer',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'concepto_id1' => 'required',
        'concepto_id2' => 'required',
        'estado_id' => 'required'
    ];

    
}
