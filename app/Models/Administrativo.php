<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class Administrativo
 * @package App\Models
 * @version May 13, 2018, 3:12 pm UTC
 *
 * @property integer persona_id
 * @property integer comision
 * @property integer estado_id
 * @property integer users_id
 */
class Administrativo extends Model
{
    

    public $table = 'administrativos';
    

    


    public $fillable = [
        'persona_id',
        'comision',
        'estado_id',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'persona_id' => 'integer',
        'comision' => 'integer',
        'estado_id' => 'integer',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'persona_id' => 'required',
        'comision' => 'required',
        'estado_id' => 'required'
    ];

    
}
