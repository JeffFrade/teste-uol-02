<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Repositories\Models\Aluno;
use Faker\Generator as Faker;

$factory->define(Aluno::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'email' => $faker->email,
        'senha' => bcrypt('123')
    ];
});
