<?php

namespace App\Repositories;

use App\Models\Vehiculos;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class VehiculosRepository
 * @package App\Repositories
 * @version April 13, 2018, 5:33 pm UTC
 *
 * @method Vehiculos findWithoutFail($id, $columns = ['*'])
 * @method Vehiculos find($id, $columns = ['*'])
 * @method Vehiculos first($columns = ['*'])
*/
class VehiculosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'persona_id',
        'placa',
        'modelo',
        'color',
        'users_id',
        'marcas_id',
        'lineas_id',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Vehiculos::class;
    }
}
