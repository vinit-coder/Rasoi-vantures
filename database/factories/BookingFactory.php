<?php

$factory->define(App\Models\Booking::class, function (Faker\Generator $faker) {
    return [
        "customer_id" => factory('App\Models\Customer')->create(),
        "room_id" => factory('App\Models\Room')->create(),
        "time_from" => $faker->date("d-m-Y H:i:s", $max = 'now'),
        "time_to" => $faker->date("d-m-Y H:i:s", $max = 'now'),
        "additional_information" => $faker->name,
    ];
});
