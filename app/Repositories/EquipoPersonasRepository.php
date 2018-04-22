<?php

namespace App\Repositories;

use App\Models\EquipoPersonas;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EquipoPersonasRepository
 * @package App\Repositories
 * @version April 22, 2018, 12:41 am UTC
 *
 * @method EquipoPersonas findWithoutFail($id, $columns = ['*'])
 * @method EquipoPersonas find($id, $columns = ['*'])
 * @method EquipoPersonas first($columns = ['*'])
*/
class EquipoPersonasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'equipo_id',
        'persona_id',
        'estado_id',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EquipoPersonas::class;
    }
}
