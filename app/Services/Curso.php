<?php

namespace App\Services;

use App\Helpers\DateHelper;
use App\Repositories\CursoRepository;

class Curso
{
    /**
     * @var CursoRepository
     */
    private $cursoRepository;

    /**
     * Curso constructor.
     */
    public function __construct()
    {
        $this->cursoRepository = new CursoRepository();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function index(array $data)
    {
        if (!empty($data['date'] ?? '')) {
            $data['date'] = DateHelper::formatDateWithoutCarbon($data['date'], 'Y-m-d');
        }

        return $this->cursoRepository->index($data['name'] ?? '', $data['date'] ?? '');
    }

    /**
     * @return int
     */
    public function indiceCursos()
    {
        return $this->cursoRepository->indiceCursos();
    }
}