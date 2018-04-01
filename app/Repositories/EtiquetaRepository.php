<?php

namespace App\Repositories;

use App\Models\Etiqueta;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EtiquetaRepository
 * @package App\Repositories
 * @version March 30, 2018, 6:54 pm CST
 *
 * @method Etiqueta findWithoutFail($id, $columns = ['*'])
 * @method Etiqueta find($id, $columns = ['*'])
 * @method Etiqueta first($columns = ['*'])
*/
class EtiquetaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'etiqueta'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Etiqueta::class;
    }
}
