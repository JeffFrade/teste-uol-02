<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Repositories\Models\Matricula;

class MatriculaRepository extends AbstractRepository
{
    /**
     * MatriculaRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Matricula();
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteByIdAluno(int $id)
    {
        $this->model->where('aluno_id', $id)
            ->delete();
    }
}