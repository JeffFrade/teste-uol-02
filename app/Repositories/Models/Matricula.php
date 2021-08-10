<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * @return HasOne
     */
    public function aluno()
    {
        return $this->hasOne(Aluno::class, 'id', 'aluno_id');
    }

    /**
     * @return HasOne
     */
    public function curso()
    {
        return $this->hasOne(Curso::class, 'id', 'curso_id');
    }
}