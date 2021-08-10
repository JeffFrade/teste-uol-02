<?php

use Illuminate\Database\Seeder;

class MatriculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Repositories\Models\Matricula::class, 100)->create();
    }
}
