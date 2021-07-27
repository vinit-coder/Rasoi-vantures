<?php

$factory->define(App\Models\Room::class, function (Faker\Generator $faker) {
    return [
        "room_number" => $faker->name,
        "floor" => $faker->randomNumber(2),
        "description" => $faker->name,
    ];
});
