<?php

namespace App\Repositories;

use App\Models\Linea;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class LineaRepository
 * @package App\Repositories
 * @version April 24, 2018, 1:58 am UTC
 *
 * @method Linea findWithoutFail($id, $columns = ['*'])
 * @method Linea find($id, $columns = ['*'])
 * @method Linea first($columns = ['*'])
*/
class LineaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'marca_id',
        'descripcion',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Linea::class;
    }
}
