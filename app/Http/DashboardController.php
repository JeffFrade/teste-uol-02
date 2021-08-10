<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Services\Aluno;
use App\Services\Curso;
use App\Services\Matricula;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * @var Aluno
     */
    private $aluno;

    /**
     * @var Curso
     */
    private $curso;

    /**
     * @var Matricula
     */
    private $matricula;

    /**
     * DashboardController constructor.
     * @param Aluno $aluno
     * @param Curso $curso
     * @param Matricula $matricula
     */
    public function __construct(Aluno $aluno, Curso $curso, Matricula $matricula)
    {
        $this->aluno = $aluno;
        $this->curso = $curso;
        $this->matricula = $matricula;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $indiceAlunos = $this->aluno->indiceAlunos();
        $indiceCursos = $this->curso->indiceCursos();
        $indiceMatriculasAtivas = $this->matricula->indiceMatriculasAtivas();

        return view('dashboard', compact('indiceAlunos', 'indiceCursos', 'indiceMatriculasAtivas'));
    }
}