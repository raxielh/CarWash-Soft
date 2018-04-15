<?php

namespace App\Repositories;

use App\Models\GaleriaVehiculos;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class GaleriaVehiculosRepository
 * @package App\Repositories
 * @version April 15, 2018, 4:57 pm UTC
 *
 * @method GaleriaVehiculos findWithoutFail($id, $columns = ['*'])
 * @method GaleriaVehiculos find($id, $columns = ['*'])
 * @method GaleriaVehiculos first($columns = ['*'])
*/
class GaleriaVehiculosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'vehiculo_id',
        'foto',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return GaleriaVehiculos::class;
    }
}
