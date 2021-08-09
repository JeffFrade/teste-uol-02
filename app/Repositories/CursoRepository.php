<?php

namespace App\Repositories;

use App\Core\Support\AbstractRepository;
use App\Repositories\Models\Curso;

class CursoRepository extends AbstractRepository
{
    /**
     * CursoRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Curso();
    }

    /**
     * @param string $name
     * @param string $date
     * @return mixed
     */
    public function index(string $name, string $date)
    {
        $model = $this->model;

        if (!empty($name)) {
            $model = $model->where('nome', 'like', '%' . $name . '%');
        }

        if (!empty($date)) {
            $model = $model->where('data_inicio', '>=', $date . ' 00:00:00')
                ->where('data_inicio', '<=', $date . ' 23:59:59');
        }

        return $model->paginate();
    }

    /**
     * @return int
     */
    public function indiceCursos()
    {
        return $this->model->count();
    }
}