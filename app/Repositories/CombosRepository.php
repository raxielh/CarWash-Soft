<?php

namespace App\Repositories;

use App\Models\Combos;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CombosRepository
 * @package App\Repositories
 * @version April 18, 2018, 12:18 am UTC
 *
 * @method Combos findWithoutFail($id, $columns = ['*'])
 * @method Combos find($id, $columns = ['*'])
 * @method Combos first($columns = ['*'])
*/
class CombosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'concepto_id1',
        'concepto_id2',
        'estado_id',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Combos::class;
    }
}
