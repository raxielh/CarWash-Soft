<?php

namespace App\Repositories;

use App\Models\Equipos;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EquiposRepository
 * @package App\Repositories
 * @version April 15, 2018, 8:19 pm UTC
 *
 * @method Equipos findWithoutFail($id, $columns = ['*'])
 * @method Equipos find($id, $columns = ['*'])
 * @method Equipos first($columns = ['*'])
*/
class EquiposRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'codigo',
        'descripcion',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Equipos::class;
    }
}
