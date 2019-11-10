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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'username' => $faker->firstName,
        'lname' => $faker->lastName,
        'fname' => $faker->firstName,
        'mname' => $faker->lastName,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'field' => $faker->randomElement(["Languages","Mathematics","Information Technology",
                "Business","Accountancy","Biology","Medical","Research","Religion"]),
        'active' => true,
        'password' => bcrypt('password'),
        'dept_id' => $faker->randomElement([1,2,3,4,5,6,7,8,9]),
        'remember_token' => $faker->text(20),
    ];
});
