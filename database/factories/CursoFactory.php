<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Repositories\Models\Curso;
use Faker\Generator as Faker;

$factory->define(Curso::class, function (Faker $faker) {
    return [
        'nome' => $faker->firstName,
        'data_inicio' => $faker->dateTime()
    ];
});
