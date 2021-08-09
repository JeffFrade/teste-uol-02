<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Services\Aluno;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * @var Aluno
     */
    private $aluno;

    public function __construct(Aluno $aluno)
    {
        $this->aluno = $aluno;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $indiceAlunos = $this->aluno->indiceAlunos();

        return view('dashboard', compact('indiceAlunos'));
    }
}