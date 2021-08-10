<?php

namespace App\Services;

use App\Exceptions\AlunoNotFoundException;
use App\Exceptions\CursoNotFoundException;
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
     * @var Aluno
     */
    private $aluno;

    /**
     * @var Curso
     */
    private $curso;

    /**
     * Matricula constructor.
     */
    public function __construct()
    {
        $this->matriculaRepository = new MatriculaRepository();
        $this->aluno = new Aluno();
        $this->curso = new Curso();
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
        $matricula = $this->matriculaRepository->findFirst('id', $id);

        if (!empty($matricula)) {
            $matricula->data_admissao = StringHelper::replaceRegex(
                $matricula->data_admissao ?? '',
                '/\s[\w\W]+/i',
                ''
            );

            return $matricula;
        }

        throw new MatriculaNotFoundException('Matrícula inexistente');
    }

    /**
     * @param array $data
     * @throws AlunoNotFoundException
     * @throws CursoNotFoundException
     * @return void
     */
    public function store(array $data)
    {
        $this->aluno->show($data['aluno_id']);
        $this->curso->show($data['curso_id']);
        $data['data_admissao'] .= ' 00:00:00';

        $this->matriculaRepository->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @throws AlunoNotFoundException
     * @throws CursoNotFoundException
     * @throws MatriculaNotFoundException
     * @return void
     */
    public function update(array $data, int $id)
    {
        $this->show($id);
        $this->aluno->show($data['aluno_id']);
        $this->curso->show($data['curso_id']);

        if (!empty($data['data_admissao'])) {
            $data['data_admissao'] .= ' 00:00:00';
        }

        $this->matriculaRepository->update($data, $id);
    }

    /**
     * @param int $id
     * @throws MatriculaNotFoundException
     */
    public function delete(int $id)
    {
        $this->show($id);

        $this->matriculaRepository->delete($id);
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
