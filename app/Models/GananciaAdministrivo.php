<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class GananciaAdministrivo
 * @package App\Models
 * @version May 13, 2018, 7:46 pm UTC
 *
 * @property integer valorini
 * @property integer valorfin
 * @property integer porcenganancia
 */
class GananciaAdministrivo extends Model
{
    

    public $table = 'ganancia_administrivos';
    

    


    public $fillable = [
        'valorini',
        'valorfin',
        'porcenganancia'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'valorini' => 'integer',
        'valorfin' => 'integer',
        'porcenganancia' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'valorini' => 'required',
        'valorfin' => 'required',
        'porcenganancia' => 'required'
    ];

    
}
