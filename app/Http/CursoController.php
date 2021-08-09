<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Services\Curso;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CursoController extends Controller
{
    /**
     * @var Curso
     */
    private $curso;

    /**
     * CursoController constructor.
     * @param Curso $curso
     */
    public function __construct(Curso $curso)
    {
        $this->curso = $curso;
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $cursos = $this->curso->index($params);

        return view('curso.index', compact('params', 'cursos'));
    }
}