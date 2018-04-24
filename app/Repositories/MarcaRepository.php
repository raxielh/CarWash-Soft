<?php

namespace App\Repositories;

use App\Models\Marca;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MarcaRepository
 * @package App\Repositories
 * @version April 24, 2018, 1:50 am UTC
 *
 * @method Marca findWithoutFail($id, $columns = ['*'])
 * @method Marca find($id, $columns = ['*'])
 * @method Marca first($columns = ['*'])
*/
class MarcaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcion',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Marca::class;
    }
}
