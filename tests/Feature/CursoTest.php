<?php

namespace Tests\Feature;

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
}
