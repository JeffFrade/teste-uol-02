<?php

namespace App\Services;

use App\Repositories\MatriculaRepository;

class Matricula
{
    /**
     * @var MatriculaRepository
     */
    private $matriculaRepository;

    /**
     * Matricula constructor.
     */
    public function __construct()
    {
        $this->matriculaRepository = new MatriculaRepository();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function index(array $data)
    {
        $idAluno = $data['id_aluno'] ?? '';
        $idCurso = $data['id_curso'] ?? '';
        $status = $data['status'] ?? '';
        $dataAdmissao = $data['date'] ?? '';

        return $this->matriculaRepository->index($idAluno, $idCurso, $status, $dataAdmissao);
    }
}
