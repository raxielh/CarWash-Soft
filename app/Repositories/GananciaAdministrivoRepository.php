<?php

namespace App\Repositories;

use App\Models\GananciaAdministrivo;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class GananciaAdministrivoRepository
 * @package App\Repositories
 * @version May 13, 2018, 7:46 pm UTC
 *
 * @method GananciaAdministrivo findWithoutFail($id, $columns = ['*'])
 * @method GananciaAdministrivo find($id, $columns = ['*'])
 * @method GananciaAdministrivo first($columns = ['*'])
*/
class GananciaAdministrivoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'valorini',
        'valorfin',
        'porcenganancia'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return GananciaAdministrivo::class;
    }
}
