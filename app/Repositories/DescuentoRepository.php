<?php

namespace App\Repositories;

use App\Models\Descuento;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DescuentoRepository
 * @package App\Repositories
 * @version April 16, 2018, 12:38 am UTC
 *
 * @method Descuento findWithoutFail($id, $columns = ['*'])
 * @method Descuento find($id, $columns = ['*'])
 * @method Descuento first($columns = ['*'])
*/
class DescuentoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'codigo',
        'descripcion',
        'porcentaje',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Descuento::class;
    }
}
