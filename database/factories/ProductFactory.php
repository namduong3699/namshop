<?php

use App\Models\Catalog;
use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    $image = $faker->numberBetween(1, 80).'.jpg';
    $images = "[\"{$image}\",\"{$faker->numberBetween(1, 80)}.jpg\",\"{$faker->numberBetween(1, 80)}.jpg\",\"{$faker->numberBetween(1, 80)}.jpg\",\"{$faker->numberBetween(1, 80)}.jpg\",\"{$faker->numberBetween(1, 80)}.jpg\"]";

    $colors = "[\"{$faker->colorName}\",\"{$faker->colorName}\",\"{$faker->colorName}\",\"{$faker->colorName}\",\"{$faker->colorName}\"]";

    $catalogsId = Catalog::query()->pluck('id')->all();
    do {
        $catalogId = $faker->unique()->randomNumber();
    } while (in_array($catalogId, $catalogsId));


    return [
        'name' => $faker->streetName,
        'count' => $faker->numberBetween(0, 20),
        'catalog_id' => $catalogId,
        'size' => '["M"," L"," XL"," XXL"]',
        'color' => $colors,
        'price' => $faker->numberBetween(100, 500) * 1000,
        'discount' => $faker->numberBetween(0, 5) * 5,
        'folder' => 'products',
        'image_link' => $image,
        'image_list' => $images,
        'description' => $faker->realText(rand(250, 500)),
    ];
});
