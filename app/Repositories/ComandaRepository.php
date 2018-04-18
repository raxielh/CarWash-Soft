<?php

namespace App\Repositories;

use App\Models\Comanda;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ComandaRepository
 * @package App\Repositories
 * @version April 18, 2018, 3:21 am UTC
 *
 * @method Comanda findWithoutFail($id, $columns = ['*'])
 * @method Comanda find($id, $columns = ['*'])
 * @method Comanda first($columns = ['*'])
*/
class ComandaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'persona_id',
        'vehiculo_id',
        'estado_id',
        'observacion',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Comanda::class;
    }
}
