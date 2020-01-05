<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Categorie;
use Faker\Generator as Faker;

$factory->define(Categorie::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'is_active' => rand(1, 0)
    ];
});
