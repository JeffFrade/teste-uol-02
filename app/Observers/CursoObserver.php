<?php

namespace App\Observers;

use App\Repositories\MatriculaRepository;
use App\Repositories\Models\Curso;

class CursoObserver
{
    /**
     * @param Curso $curso
     */
    public function deleting(Curso $curso)
    {
        $matriculaRepository = new MatriculaRepository();
        $matriculaRepository->deleteByIdCurso($curso->id);
    }
}
