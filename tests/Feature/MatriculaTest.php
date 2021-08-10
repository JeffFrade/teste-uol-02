<?php

namespace Tests\Feature;

use App\Services\Matricula;
use Tests\TestCase;

class MatriculaTest extends TestCase
{
    public function testMatriculaIndex(): void
    {
        $matricula = new Matricula();

        $data = [
            'status' => 0
        ];

        $matriculas = $matricula->index($data);

        $this->assertGreaterThan(1, $matriculas->count());
    }

    public function testMatriculaIndiceDashboard(): void
    {
        $matricula = new Matricula();
        $total = $matricula->indiceMatriculasAtivas();

        $this->assertGreaterThan(1, $total);
        $this->assertIsInt($total);
    }
}
