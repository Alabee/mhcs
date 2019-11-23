<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Counselor;
use Faker\Generator as Faker;

$factory->define(Counselor::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'bio' => Str::random(100),
        'phoneNumber' => $faker->phoneNumber,
        'profileImage' => Str::random(10),
    ];
});
