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
     * @return mixed
     */
    public function index(string $search)
    {
        $model = $this->model;

        if (!empty($search)) {
            $model = $model->where('nome', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
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
