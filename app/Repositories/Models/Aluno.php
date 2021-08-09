<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    /**
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @var string
     */
    protected $table = 'alunos';

    /**
     * @var array
     */
    protected $fillable = [
        'nome',
        'email'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'senha'
    ];
}
