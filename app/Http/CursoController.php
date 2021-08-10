<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Core\Support\Traits\ErrorTrait;
use App\Exceptions\CursoNotFoundException;
use App\Services\Curso;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CursoController extends Controller
{
    use ErrorTrait;

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

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view ('curso.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $params = $this->toValidate($request);
        $this->curso->store($params);

        return redirect(route('cursos.index'))
            ->with('message', 'Curso cadastrado com sucesso!');
    }

    /**
     * @param int $id
     * @return Factory|View
     */
    public function edit(int $id)
    {
        $curso = $this->curso->show($id);

        return view('curso.edit', compact('curso'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function update(Request $request, int $id)
    {
        $params = $this->toValidate($request);
        $this->curso->update($params, $id);

        return redirect(route('cursos.index'))
            ->with('message', 'Curso editado com sucesso!');
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        try {
            $this->curso->delete($id);

            return response()->json([
                'message' => 'Curso excluído com sucesso!'
            ]);
        } catch (CursoNotFoundException $e) {
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
            'nome' => 'required|max:255',
            'date' => 'required|size:10',
            'hour' => 'required|size:5'
        ];

        return $this->validate($request, $toValidateArr);
    }
}