<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Services\Aluno;
use App\Services\Curso;
use App\Services\Matricula;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MatriculaController extends Controller
{
    /**
     * @var Matricula
     */
    private $matricula;

    /**
     * @var Aluno
     */
    private $aluno;

    /**
     * @var Curso
     */
    private $curso;

    /**
     * MatriculaController constructor.
     * @param Matricula $matricula
     * @param Aluno $aluno
     * @param Curso $curso
     */
    public function __construct(Matricula $matricula, Aluno $aluno, Curso $curso)
    {
        $this->matricula = $matricula;
        $this->aluno = $aluno;
        $this->curso = $curso;
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $matriculas = $this->matricula->index($params);
        $alunos = $this->aluno->getAll();
        $cursos = $this->curso->getAll();

        return view('matricula.index', compact('params', 'matriculas', 'alunos', 'cursos'));
    }
}
