<?php

namespace App\Services;

use App\Exceptions\MatriculaNotFoundException;
use App\Helpers\StringHelper;
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

    /**
     * @param int $id
     * @return mixed
     * @throws MatriculaNotFoundException
     */
    public function show(int $id)
    {
        $matriculas = $this->matriculaRepository->findFirst('id', $id);

        if (!empty($matriculas)) {
            $matriculas->data_admissao = StringHelper::replaceRegex(
                $curso->data_admissao ?? '',
                '/\:[\d]+$/i',
                ''
            );

            return $matriculas;
        }

        throw new MatriculaNotFoundException('Matrícula inexistente');
    }

    /**
     * @return int
     */
    public function indiceMatriculasAtivas()
    {
        return $this->matriculaRepository->indiceMatriculasAtivas();
    }

    /**
     * @param int $id
     * @throws MatriculaNotFoundException
     * @return void
     */
    public function updateStatus(int $id)
    {
        $matricula = $this->show($id);

        $data = [
            'ativo' => !(int)$matricula->ativo
        ];

        $this->matriculaRepository->update($data, $id);
    }
}
