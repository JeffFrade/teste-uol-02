<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Core\Support\Traits\ErrorTrait;
use App\Exceptions\AlunoNotFoundException;
use App\Exceptions\CursoNotFoundException;
use App\Exceptions\MatriculaNotFoundException;
use App\Services\Aluno;
use App\Services\Curso;
use App\Services\Matricula;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class MatriculaController extends Controller
{
    use ErrorTrait;

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

    /**
     * @return Factory|View
     */
    public function create()
    {
        $alunos = $this->aluno->getAll();
        $cursos = $this->curso->getAll();

        return view('matricula.create', compact('alunos', 'cursos'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        try {
            $params = $this->toValidate($request);
            $this->matricula->store($params);

            return redirect(route('matriculas.index'))
                ->with('message', 'Matrícula cadastrada com sucesso!');
        } catch (AlunoNotFoundException | CursoNotFoundException $e) {
            return redirect(route('matriculas.index'))
                ->with('error', $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function edit(int $id)
    {
        try {
            $alunos = $this->aluno->getAll();
            $cursos = $this->curso->getAll();
            $matricula = $this->matricula->show($id);

            return view('matricula.edit', compact('alunos', 'cursos', 'matricula'));
        } catch (MatriculaNotFoundException $e) {
            return redirect(route('matriculas.index'))
                ->with('error', $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function update(Request $request, int $id)
    {
        try {
            $params = $this->toValidate($request);
            $this->matricula->update($params, $id);

            return redirect(route('matriculas.index'))
                ->with('message', 'Matrícula atualizada com sucesso!');
        } catch (AlunoNotFoundException | CursoNotFoundException | MatriculaNotFoundException $e) {
            return redirect(route('matriculas.index'))
                ->with('error', $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function updateStatus(int $id)
    {
        try {
            $this->matricula->updateStatus($id);

            return response()->json([
                'message' => 'Troca de status efetuada com sucesso!'
            ]);
        } catch (MatriculaNotFoundException $e) {
            return response()->json($this->errorFromException($e));
        }
    }

    /**
     * @param Request $request
     * @return array
     * @throws ValidationException
     */
    protected function toValidate(Request $request)
    {
        $toValidateArr = [
            'curso_id' => 'required',
            'aluno_id' => 'required',
            'ativo' => 'required|size:1',
            'data_admissao' => 'required|size:10'
        ];

        return $this->validate($request, $toValidateArr);
    }
}
