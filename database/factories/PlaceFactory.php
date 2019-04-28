<?php

use Faker\Generator as Faker;

$factory->define(App\Place::class, function (Faker $faker) {
    return [
        'domain' => $faker->state,
        'municipality' => $faker->city,
        'address' => $faker->streetAddress,
    ];
});
