<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Services\Aluno;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
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

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('aluno.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $params = $this->toValidate($request);
        $this->aluno->store($params);

        return redirect(route('alunos.index'))
            ->with('message', 'Aluno cadastrado com sucesso!');
    }

    /**
     * @param Request $request
     * @param bool $isUpdate
     * @return array
     * @throws ValidationException
     */
    protected function toValidate(Request $request, bool $isUpdate = false)
    {
        $toValidateArr = [
            'nome' => 'required|max:255',
            'email' => 'required|max:255',
            'senha' => 'required|max:255'
        ];

        if ($isUpdate) {
            unset($toValidateArr['senha']);
        }

        return $this->validate($request, $toValidateArr);
    }
}
