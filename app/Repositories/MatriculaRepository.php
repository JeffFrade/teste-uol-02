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

    /**
     * @param int $id
     */
    public function deleteByIdCurso(int $id)
    {
        $this->model->where('curso_id', $id)
            ->delete();
    }
}