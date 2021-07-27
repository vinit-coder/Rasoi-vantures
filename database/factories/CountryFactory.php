<?php

$factory->define(App\Models\Country::class, function (Faker\Generator $faker) {
    return [
        "shortcode" => $faker->name,
        "title" => $faker->name,
        "name" => $faker->name,
    ];
});
