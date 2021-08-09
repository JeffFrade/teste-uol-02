<?php

namespace Tests\Feature;

use App\Services\Curso;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CursoTest extends TestCase
{
    use DatabaseTransactions;

    public function testAlunosIndex(): void
    {
        $curso = new Curso();
        $params = [];
        $cursos = $curso->index($params);

        $this->assertEquals(10, $cursos->count());
        $this->assertEquals(1, $cursos->lastPage());
    }

    public function testAlunosIndiceDashboard(): void
    {
        $curso = new Curso();
        $total = $curso->indiceCursos();

        $this->assertEquals(10, $total);
        $this->assertIsInt($total);
    }
}
