<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    /**
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @var string
     */
    protected $table = 'cursos';

    /**
     * @var array
     */
    protected $fillable = [
        'nome',
        'data_inicio'
    ];
}
