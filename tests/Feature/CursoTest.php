<?php

namespace Tests\Feature;

use App\Exceptions\CursoNotFoundException;
use App\Services\Curso;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CursoTest extends TestCase
{
    use DatabaseTransactions;

    public function testCursosIndex(): void
    {
        $curso = new Curso();
        $params = [];
        $cursos = $curso->index($params);

        $this->assertEquals(10, $cursos->count());
        $this->assertEquals(1, $cursos->lastPage());
    }

    public function testCursosIndiceDashboard(): void
    {
        $curso = new Curso();
        $total = $curso->indiceCursos();

        $this->assertEquals(10, $total);
        $this->assertIsInt($total);
    }

    public function testCursoStore(): void
    {
        $curso = new Curso();

        $params = [
            'nome' => 'Admin',
            'date' => '15/06/2018',
            'hour' => '15:30'
        ];

        $curso->store($params);

        $params = [
            'name' => 'Admin',
        ];

        $curso = $curso->index($params);
        $this->assertEquals(1, $curso->count());
    }

    public function testCursoShow(): void
    {
        $curso = new Curso();
        $curso = $curso->show(1);

        $this->assertNotEmpty($curso);
    }

    public function testCursoUpdate(): void
    {
        $curso = new Curso();

        $data = [
            'nome' => 'Admin'
        ];

        $curso->update($data, 1);
        $curso = $curso->show(1);

        $this->assertEquals('Admin', $curso->nome);
    }

    public function testCursoDelete(): void
    {
        $curso = new Curso();
        $curso->delete(2);

        $curso = $curso->show(2);
        $this->assertEmpty($curso);
    }

    public function testCursoDeleteCursoNotFoundException(): void
    {
        $this->expectException(CursoNotFoundException::class);

        $curso = new Curso();
        $curso->delete(2000);
    }
}
