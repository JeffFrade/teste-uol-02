<?php

namespace Tests\Feature;

use App\Exceptions\AlunoNotFoundException;
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

    public function testAlunoStore(): void
    {
        $aluno = new Aluno();

        $params = [
            'nome' => 'Admin',
            'email' => 'admin@mail.com',
            'senha' => '123'
        ];

        $aluno->store($params);

        $params = [
            'search' => 'admin@mail.com',
        ];

        $aluno = $aluno->index($params);
        $this->assertEquals(1, $aluno->count());
    }

    public function testAlunoShow(): void
    {
        $aluno = new Aluno();
        $aluno = $aluno->show(1);

        $this->assertNotEmpty($aluno);
    }

    public function testAlunoShowAlunoNotFoundException(): void
    {
        $this->expectException(AlunoNotFoundException::class);

        $aluno = new Aluno();
        $aluno->show(2000);
    }

    public function testAlunoUpdate(): void
    {
        $aluno = new Aluno();

        $data = [
            'email' => 'admin@mail.com'
        ];

        $aluno->update($data, 1);
        $aluno = $aluno->show(1);

        $this->assertEquals('admin@mail.com', $aluno->email);
    }

    public function testAlunoDelete(): void
    {
        $this->expectException(AlunoNotFoundException::class);

        $aluno = new Aluno();
        $aluno->delete(2);

        $aluno = $aluno->show(2);
        $this->expectExceptionMessage('Aluno inexistente');
    }

    public function testAlunoDeleteAlunoNotFoundException(): void
    {
        $this->expectException(AlunoNotFoundException::class);

        $aluno = new Aluno();
        $aluno->delete(2000);

        $this->expectExceptionMessage('Aluno inexistente');
    }
}