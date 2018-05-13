<?php

namespace App\Repositories;

use App\Models\Administrativo;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AdministrativoRepository
 * @package App\Repositories
 * @version May 13, 2018, 3:12 pm UTC
 *
 * @method Administrativo findWithoutFail($id, $columns = ['*'])
 * @method Administrativo find($id, $columns = ['*'])
 * @method Administrativo first($columns = ['*'])
*/
class AdministrativoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'persona_id',
        'comision',
        'estado_id',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Administrativo::class;
    }
}
