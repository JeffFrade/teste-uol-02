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
     * @param array $params
     * @return mixed
     */
    public function index(array $params)
    {
        return $this->alunoRepository->index($params['search'] ?? '', $params['date'] ?? '');
    }
}
