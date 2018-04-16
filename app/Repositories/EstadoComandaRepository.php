<?php

namespace App\Repositories;

use App\Models\EstadoComanda;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EstadoComandaRepository
 * @package App\Repositories
 * @version April 15, 2018, 11:50 pm UTC
 *
 * @method EstadoComanda findWithoutFail($id, $columns = ['*'])
 * @method EstadoComanda find($id, $columns = ['*'])
 * @method EstadoComanda first($columns = ['*'])
*/
class EstadoComandaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcion',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EstadoComanda::class;
    }
}
