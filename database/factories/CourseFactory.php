<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    $progs = App\Program::pluck('id')->toArray();
    $codes = ['English','History','Math','Econ','ITE','Bus','Mgt','Educ','Science'];
    return [
        'code' => $faker->numerify($faker->randomElement($codes) . ' ###'),
        'description' => $faker->words(5,true),
        'units' => $faker->randomFloat(1,1,3),
        'academic' => true,
        'program_id' => $faker->randomElement($progs)
    ];
});
