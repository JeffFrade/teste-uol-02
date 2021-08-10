<?php

namespace Tests\Feature;

use App\Exceptions\MatriculaNotFoundException;
use App\Services\Matricula;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MatriculaTest extends TestCase
{
    use DatabaseTransactions;

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

    public function testMatriculaUpdateStatus(): void
    {
        $matricula = new Matricula();

        $data = [
            'status' => 0
        ];

        $matriculas = $matricula->index($data);
        $matricula->updateStatus($matriculas[0]->id);
        $matricula = $matricula->show($matriculas[0]->id);

        $this->assertTrue((bool) $matricula->ativo);
    }

    public function testMatriculaUpdateStatusMatriculaNotFoundException(): void
    {
        $this->expectException(MatriculaNotFoundException::class);

        $matricula = new Matricula();
        $matricula->updateStatus(2000);

        $this->expectExceptionMessage('Matrícula inexistente');
    }
}
