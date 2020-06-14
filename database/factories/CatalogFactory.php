<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Catalog::class, function (Faker $faker) {
    return [
        'name' => $faker->streetName,
        'count' => $faker->numberBetween(0, 50),
    ];
});
