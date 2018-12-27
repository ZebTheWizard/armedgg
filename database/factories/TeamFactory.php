<?php

use Faker\Generator as Faker;

$factory->define(App\Team::class, function (Faker $faker) {
    return [
        'id' => guid(),
        'name' => $faker->company,
        'logo' => $faker->imageUrl(128, 128, 'abstract'),
        'color' => $faker->hexcolor,
        'overview' => $faker->sentences(3, true),
    ];
});
