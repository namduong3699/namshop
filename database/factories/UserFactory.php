<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        // 'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'level' => 1,
        'admin_access' => false,
        'phone' => $faker->phoneNumber,
        'address' => '{"tinh":"Th\u00e0nh ph\u1ed1 H\u00e0 N\u1ed9i","huyen":"Huy\u1ec7n \u0110\u00f4ng Anh","xa":"X\u00e3 Nam H\u1ed3ng"}',
        'remember_token' => str_random(10),
    ];
});
