<?php

namespace App\Services;

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
}
