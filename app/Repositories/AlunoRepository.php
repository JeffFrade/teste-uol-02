<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Repositories\Models\Aluno;

class AlunoRepository extends AbstractRepository
{
    /**
     * AlunoRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Aluno();
    }

    /**
     * @param string $search
     * @param string $date
     * @return mixed
     */
    public function index(string $search, string $date)
    {
        $model = $this->model;

        if (!empty($search)) {
            $model = $model->where('nome', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }

        if (!empty($date)) {
            $model = $model->where('data_admissao', $date);
        }

        return $model->paginate();
    }

    /**
     * @return int
     */
    public function indiceAlunos()
    {
        return $this->model->count();
    }
}
