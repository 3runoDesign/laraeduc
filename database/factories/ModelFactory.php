<?php

use Faker as Faker;

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

$factory->define(\SON\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'enrolment' => str_random(10)
    ];
});


$factory->define(\SON\Models\UserProfile::class, function (Faker\Generator $faker){
    return [
        'address' => $faker->address,
        'cep' => function() use($faker){
            $cep = preg_replace('/[^0-9]/','', $faker->postcode());
            return $cep;
        },
        'number' => rand(1,100),
        'complement' => rand(1,10)%2==0?null:$faker->sentence,
        'city' => $faker->city,
        'neighborhood' => $faker->city,
        'state' => collect(\SON\Models\State::$states)->random(),
    ];
});

$factory->define(\SON\Models\Subject::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(\SON\Models\ClassInformation::class, function (Faker\Generator $faker) {
    return [
        'date_start' => $faker->date(),
        'date_end' => $faker->date(),
        'cycle' => rand(1,8),
        'subdivision' => rand(1,16),
        'semester' => rand(1,2),
        'year' => rand(2017,2030),
    ];
});