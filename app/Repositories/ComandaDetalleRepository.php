<?php

namespace App\Repositories;

use App\Models\ComandaDetalle;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ComandaDetalleRepository
 * @package App\Repositories
 * @version April 20, 2018, 4:29 pm UTC
 *
 * @method ComandaDetalle findWithoutFail($id, $columns = ['*'])
 * @method ComandaDetalle find($id, $columns = ['*'])
 * @method ComandaDetalle first($columns = ['*'])
*/
class ComandaDetalleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'comanda_id',
        'concepto_id',
        'cantidad',
        'descuentos_id',
        'valor',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ComandaDetalle::class;
    }
}
