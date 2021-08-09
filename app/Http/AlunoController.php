<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Services\Aluno;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlunoController extends Controller
{
    /**
     * @var Aluno
     */
    private $aluno;

    /**
     * AlunoController constructor.
     * @param Aluno $aluno
     */
    public function __construct(Aluno $aluno)
    {
        $this->aluno = $aluno;
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $alunos = $this->aluno->index($params);

        return view('aluno.index', compact('params', 'alunos'));
    }
}
