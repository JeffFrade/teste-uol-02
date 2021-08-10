<?php

namespace App\Services;

use App\Helpers\DateHelper;
use App\Helpers\StringHelper;
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
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        $data['data_inicio'] = $this->formatDate($data['date'], $data['hour']);

        unset($data['date']);
        unset($data['hour']);

        $this->cursoRepository->create($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        $curso = $this->cursoRepository->findFirst('id', $id);
        $curso->data_inicio = StringHelper::replaceRegex($curso->data_inicio, '/\:[\d]+$/i', '');

        return $curso;
    }

    /**
     * @param array $data
     * @param int $id
     * @return void
     */
    public function update(array $data, int $id)
    {
        $data['data_inicio'] = $this->formatDate($data['date'], $data['hour']);

        unset($data['date']);
        unset($data['hour']);

        $this->cursoRepository->update($data, $id);
    }

    /**
     * @param string $date
     * @param string $hour
     * @return string
     */
    private function formatDate(string $date, string $hour)
    {
        $date = DateHelper::formatBrDate($date);
        return sprintf('%s %s:00', $date, $hour);
    }

    /**
     * @return int
     */
    public function indiceCursos()
    {
        return $this->cursoRepository->indiceCursos();
    }
}