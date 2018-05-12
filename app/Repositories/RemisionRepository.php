<?php

namespace App\Repositories;

use App\Models\Remision;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RemisionRepository
 * @package App\Repositories
 * @version May 12, 2018, 7:58 pm UTC
 *
 * @method Remision findWithoutFail($id, $columns = ['*'])
 * @method Remision find($id, $columns = ['*'])
 * @method Remision first($columns = ['*'])
*/
class RemisionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcion',
        'persona_id',
        'proveedor_id',
        'concepto_id',
        'tipo_remision_id',
        'fecha',
        'valor',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Remision::class;
    }
}
