<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class Lavado
 * @package App\Models
 * @version April 18, 2018, 9:40 pm UTC
 *
 * @property integer comanda_id
 * @property integer equipo_id
 * @property integer users_id
 */
class Lavado extends Model
{
    

    public $table = 'lavados';
    

    


    public $fillable = [
        'comanda_id',
        'equipo_id',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'comanda_id' => 'integer',
        'equipo_id' => 'integer',
        'users_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'comanda_id' => 'required',
        'equipo_id' => 'required'
    ];

    
}
