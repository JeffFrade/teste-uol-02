<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Repositories\Models\Matricula;
use Faker\Generator as Faker;

$factory->define(Matricula::class, function (Faker $faker) {
    return [
        'curso_id' => rand(1, 10),
        'aluno_id' => rand(1, 50),
        'ativo' => rand(0, 1),
        'data_admissao' => $faker->dateTime()
    ];
});
