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

    /**
     * @param string $idAluno
     * @param string $idCurso
     * @param string $status
     * @param string $dataAdmissao
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(string $idAluno, string $idCurso, string $status, string $dataAdmissao)
    {
        $model = $this->model
            ->with(['aluno', 'curso']);

        if (!empty($idAluno)) {
            $model = $model->where('aluno_id', $idAluno);
        }

        if (!empty($idCurso)) {
            $model = $model->where('curso_id', $idCurso);
        }

        if ($status != '') {
            $model = $model->where('ativo', $status);
        }

        if (!empty($dataAdmissao)) {
            $model = $model->where('data_admissao', '>=', $dataAdmissao . ' 00:00:00')
                ->where('data_admissao', '<=', $dataAdmissao . ' 23:59:59');
        }

        return $model->paginate();
    }

    /**
     * @return int
     */
    public function indiceMatriculasAtivas()
    {
        return $this->model->where('ativo', 1)
            ->count();
    }
}