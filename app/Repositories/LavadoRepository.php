<?php

namespace App\Repositories;

use App\Models\Lavado;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class LavadoRepository
 * @package App\Repositories
 * @version April 18, 2018, 9:40 pm UTC
 *
 * @method Lavado findWithoutFail($id, $columns = ['*'])
 * @method Lavado find($id, $columns = ['*'])
 * @method Lavado first($columns = ['*'])
*/
class LavadoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'comanda_id',
        'equipo_id',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Lavado::class;
    }
}
