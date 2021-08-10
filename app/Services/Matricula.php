<?php

namespace App\Services;

use App\Repositories\MatriculaRepository;

class Matricula
{
    /**
     * @var MatriculaRepository
     */
    private $matriculaRepository;

    public function __construct()
    {
        $this->matriculaRepository = new MatriculaRepository();
    }
}
