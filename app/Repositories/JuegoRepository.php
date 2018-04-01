<?php

namespace App\Repositories;

use App\Models\Juego;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JuegoRepository
 * @package App\Repositories
 * @version March 31, 2018, 5:25 pm CST
 *
 * @method Juego findWithoutFail($id, $columns = ['*'])
 * @method Juego find($id, $columns = ['*'])
 * @method Juego first($columns = ['*'])
*/
class JuegoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'link_gamesfull',
        'link_mega',
        'link_drive',
        'link_ml'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Juego::class;
    }
}
