<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Services\Aluno;
use App\Services\Curso;
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

    public function __construct(Aluno $aluno, Curso $curso)
    {
        $this->aluno = $aluno;
        $this->curso = $curso;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $indiceAlunos = $this->aluno->indiceAlunos();
        $indiceCursos = $this->curso->indiceCursos();

        return view('dashboard', compact('indiceAlunos', 'indiceCursos'));
    }
}