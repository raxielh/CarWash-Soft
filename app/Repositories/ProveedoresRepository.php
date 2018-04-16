<?php

namespace App\Repositories;

use App\Models\Proveedores;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProveedoresRepository
 * @package App\Repositories
 * @version April 16, 2018, 1:55 am UTC
 *
 * @method Proveedores findWithoutFail($id, $columns = ['*'])
 * @method Proveedores find($id, $columns = ['*'])
 * @method Proveedores first($columns = ['*'])
*/
class ProveedoresRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'codigo',
        'persona_id',
        'razon_social',
        'nit',
        'direccion',
        'telefono2',
        'telefono1',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Proveedores::class;
    }
}
