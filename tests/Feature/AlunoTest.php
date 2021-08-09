<?php

namespace Tests\Feature;

use App\Services\Aluno;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AlunoTest extends TestCase
{
    use DatabaseTransactions;

    public function testAlunosIndex(): void
    {
        $aluno = new Aluno();
        $params = [];
        $alunos = $aluno->index($params);

        $this->assertEquals(15, $alunos->count());
        $this->assertEquals(4, $alunos->lastPage());
    }

    public function testAlunosIndiceDashboard(): void
    {
        $aluno = new Aluno();
        $total = $aluno->indiceAlunos();

        $this->assertEquals(50, $total);
        $this->assertIsInt($total);
    }
}