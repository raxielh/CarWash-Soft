<?php

namespace App\Repositories;

use App\Models\Configuracion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ConfiguracionRepository
 * @package App\Repositories
 * @version May 12, 2018, 11:14 pm UTC
 *
 * @method Configuracion findWithoutFail($id, $columns = ['*'])
 * @method Configuracion find($id, $columns = ['*'])
 * @method Configuracion first($columns = ['*'])
*/
class ConfiguracionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'concepto_admin_gasto',
        'concepto_lavador_gasto'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Configuracion::class;
    }
}
