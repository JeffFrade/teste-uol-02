<?php

namespace Tests\Feature;

use App\Exceptions\AlunoNotFoundException;
use App\Exceptions\CursoNotFoundException;
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

    public function testMatriculaStore(): void
    {
        $matricula = new Matricula();

        $data = [
            'aluno_id' => 5,
            'curso_id' => 7,
            'ativo' => 1,
            'data_admissao' => '2015-05-08'
        ];

        $matricula->store($data);

        $data = [
            'id_aluno' => 5,
            'id_curso' => 7,
            'status' => 1,
            'date' => '2015-05-08'
        ];

        $matriculas = $matricula->index($data);

        $this->assertEquals(1, $matriculas->count());
    }

    public function testMatriculaStoreAlunoNotFoundException(): void
    {
        $this->expectException(AlunoNotFoundException::class);

        $matricula = new Matricula();

        $data = [
            'aluno_id' => 5000,
            'curso_id' => 7,
            'ativo' => 1,
            'data_admissao' => '2015-05-08'
        ];

        $matricula->store($data);

        $this->expectExceptionMessage('Aluno inexistente');
    }

    public function testMatriculaStoreCursoNotFoundException(): void
    {
        $this->expectException(CursoNotFoundException::class);

        $matricula = new Matricula();

        $data = [
            'aluno_id' => 5,
            'curso_id' => 7000,
            'ativo' => 1,
            'data_admissao' => '2015-05-08'
        ];

        $matricula->store($data);

        $this->expectExceptionMessage('Curso inexistente');
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
