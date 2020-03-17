<?php

use Faker\Generator as Faker;

$factory->define(App\Student::class, function (Faker $faker) {
    $lastName = $faker->lastName;
    return [
        'id' => rand(234565,999999),
        'lrn' => rand(43454522,99999999),
        'lname' => $lastName,
        'fname' => $faker->firstName,
        'mname' => $faker->lastName,
        'bdate' => $faker->date,
        'gender' => (['female','male'])[rand(0,1)],
        'barangay' => $faker->streetName,
        'town' => $faker->city,
        'province' => (['Bohol','Leyte','Cebu'])[rand(0,2)],
        'phone' => $faker->phoneNumber,
        'religion' => (['Roman Catholic','Jehova\'s Witness', 'Iglesia ni Cristo'])[rand(0,2)],
        'citizenship' => 'Filipino',
        'mother' => $faker->firstName('female') . " " . $lastName,
        'mphone' => $faker->phoneNumber,
        'father' => $faker->firstName('male') . " " . $lastName,
        'fphone' => $faker->phoneNumber,
        'pr_address' => $faker->address
    ];
});
