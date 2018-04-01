<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Juego
 * @package App\Models
 * @version March 31, 2018, 5:25 pm CST
 *
 * @property \Illuminate\Database\Eloquent\Collection GeneroJuego
 * @property \Illuminate\Database\Eloquent\Collection optionUser
 * @property \Illuminate\Database\Eloquent\Collection rolUser
 * @property string nombre
 * @property string link_gamesfull
 * @property string link_mega
 * @property string link_drive
 * @property string link_ml
 */
class Juego extends Model
{
    use SoftDeletes;

    public $table = 'juegos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'link_gamesfull',
        'link_mega',
        'link_drive',
        'link_ml'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'link_gamesfull' => 'string',
        'link_mega' => 'string',
        'link_drive' => 'string',
        'link_ml' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function generoJuegos()
    {
        return $this->hasMany(\App\Models\GeneroJuego::class);
    }
}
