<?php

namespace App\Services;

use App\Exceptions\AlunoNotFoundException;
use App\Repositories\AlunoRepository;

class Aluno
{
    /**
     * @var AlunoRepository
     */
    private $alunoRepository;

    /**
     * Aluno constructor.
     */
    public function __construct()
    {
        $this->alunoRepository = new AlunoRepository();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function index(array $data)
    {
        return $this->alunoRepository->index($data['search'] ?? '');
    }

    /**
     * @return int
     */
    public function indiceAlunos()
    {
        return $this->alunoRepository->indiceAlunos();
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        $data['senha'] = bcrypt($data['senha']);

        $this->alunoRepository->create($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        return $this->alunoRepository->findFirst('id', $id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return void
     */
    public function update(array $data, int $id)
    {
        if (isset($data['senha'])) {
            $data['senha'] = bcrypt($data['senha']);
        }

        $this->alunoRepository->update($data, $id);
    }

    /**
     * @param int $id
     * @throws AlunoNotFoundException
     * @return void
     */
    public function delete(int $id)
    {
        $aluno = $this->show($id);

        if (empty($aluno)) {
            throw new AlunoNotFoundException('Aluno inexistente');
        }

        $this->alunoRepository->delete($id);
    }
}
