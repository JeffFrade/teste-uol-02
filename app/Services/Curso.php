<?php

namespace App\Services;

use App\Exceptions\CursoNotFoundException;
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
     * @throws CursoNotFoundException
     */
    public function show(int $id)
    {
        $curso = $this->cursoRepository->findFirst('id', $id);

        if (!empty($curso)) {
            $curso->data_inicio = StringHelper::replaceRegex(
                $curso->data_inicio ?? '',
                '/\:[\d]+$/i',
                ''
            );

            return $curso;
        }

        throw new CursoNotFoundException('Curso inexistente');
    }

    /**
     * @param array $data
     * @param int $id
     * @throws CursoNotFoundException
     */
    public function update(array $data, int $id)
    {
        $this->show($id);

        if (isset($data['date']) && isset($data['hour'])) {
            $data['data_inicio'] = $this->formatDate($data['date'], $data['hour']);

            unset($data['date']);
            unset($data['hour']);
        }

        $this->cursoRepository->update($data, $id);
    }

    /**
     * @param int $id
     * @throws CursoNotFoundException
     */
    public function delete(int $id)
    {
        $curso = $this->show($id);

        $this->cursoRepository->delete($id);
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