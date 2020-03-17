<?php

use Faker\Generator as Faker;

$factory->define(App\Room::class, function (Faker $faker) {
    return [
        'code' => $faker->numerify('Room ###'),
        'name' => "St. " . $faker->firstName,
        'building' => $faker->randomElement(['ITSC Building', 'Administrative Building', 'SHS Building', 'JHS Building', 'Old Building']),
        'floor' => $faker->numberBetween(1,4),
        'capacity' => $faker->randomElement([40,50,60])
    ];
});
