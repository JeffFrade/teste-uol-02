<?php

namespace App\Observers;

use App\Repositories\MatriculaRepository;
use App\Repositories\Models\Aluno;

class AlunoObserver
{
    /**
     * @param Aluno $aluno
     */
    public function deleting(Aluno $aluno)
    {
        $matriculaRepository = new MatriculaRepository();
        $matriculaRepository->deleteByIdAluno($aluno->id);
    }
}
