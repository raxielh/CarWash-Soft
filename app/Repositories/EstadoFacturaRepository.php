<?php

namespace App\Repositories;

use App\Models\EstadoFactura;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EstadoFacturaRepository
 * @package App\Repositories
 * @version April 15, 2018, 11:11 pm UTC
 *
 * @method EstadoFactura findWithoutFail($id, $columns = ['*'])
 * @method EstadoFactura find($id, $columns = ['*'])
 * @method EstadoFactura first($columns = ['*'])
*/
class EstadoFacturaRepository extends BaseRepository
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
        return EstadoFactura::class;
    }
}
