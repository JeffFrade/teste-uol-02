<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Services\Matricula;

class MatriculaController extends Controller
{
    /**
     * @var Matricula
     */
    private $matricula;

    /**
     * MatriculaController constructor.
     * @param Matricula $matricula
     */
    public function __construct(Matricula $matricula)
    {
        $this->matricula = $matricula;
    }
}
