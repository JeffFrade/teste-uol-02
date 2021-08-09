<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    /**
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @var string
     */
    protected $table = 'matriculas';

    protected $fillable = [
        'curso_id',
        'aluno_id',
        'ativo',
        'data_admissao'
    ];
}